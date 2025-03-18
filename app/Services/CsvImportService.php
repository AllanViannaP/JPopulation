<?php

namespace App\Services;

use App\Repositories\PopulationDataRepository;
use App\Entities\PopulationData;
use App\Entities\Prefecture;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class CsvImportService
{
    private PopulationDataRepository $repository;
    private EntityManagerInterface $entityManager;

    public function __construct(
        PopulationDataRepository $repository,
        EntityManagerInterface $entityManager
    ) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    public function importFromCsv(string $filePath): void
    {
        $handle = fopen($filePath, 'r');

        if (!$handle) {
            throw new Exception("Erro ao abrir o arquivo CSV.");
        }

        // Ler e converter a primeira linha do cabeçalho
        $header = fgetcsv($handle, 1000, ",");
        $header = array_map(fn($col) => mb_convert_encoding($col, "UTF-8", "SJIS-win"), $header);

        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            // Converter cada coluna do CSV
            $data = array_map(fn($col) => mb_convert_encoding($col, "UTF-8", "SJIS-win"), $data);

            $prefectureName = $data[0];
            $year = (int)$data[1];
            $population = (int)$data[2];

            // Buscar a prefeitura usando Doctrine
            $prefecture = $this->entityManager->getRepository(Prefecture::class)
                ->findOneBy(['name' => $prefectureName]);

            if ($prefecture) {
                $populationData = new PopulationData($prefecture, $year, $population);
                $this->repository->save($populationData);
            }
        }

        fclose($handle);
    }
}
