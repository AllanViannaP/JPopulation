# JPopulation  
> **Status:** Finished ✅ | **ステータス:** 完了 ✅  

## **About | 概要**  
A Laravel-based application to import and display Japanese population data from CSV.  
日本の人口データを CSV からインポートし、表示する Laravel アプリケーションです。  

## **Technologies Used | 使用技術**  
- [PHP>=8.0](https://www.php.net/)  
- [Composer](https://getcomposer.org/)  
- [Laravel](https://laravel.com/)  
- [PHPMyAdmin](https://www.phpmyadmin.net/)  
- [Bootstrap](https://getbootstrap.com/)  

---

## **Installation Steps | インストール手順**  

### **1. Clone the Repository | リポジトリをクローン**  
```sh
git clone https://github.com/AllanViannaP/JPopulation.git
```
### **2. Install Dependencies | 依存関係をインストール**  
```sh
composer install
```
### **3. Create the Database | データベースの作成**  
⚠ **Warning:** Before running migrations, manually create the database in MySQL or phpMyAdmin.  
⚠ **警告:** マイグレーションを実行する前に、MySQL または phpMyAdmin でデータベースを手動で作成してください。  

### **4. Set Up Environment | 環境設定**  
```sh
cp .env.example .env  
```
⚠ **Warning:** Update the `.env` file with your database credentials.  
⚠ **警告:** `.env` ファイルを開いて、データベース設定を編集してください。  

### **5. Run Database Migrations | データベースマイグレーションを実行**  
```sh
php artisan migrate
```
### **6. Serve the Application | アプリケーションを起動**  
```sh
php artisan serve  
```
---

## **Using the Application | アプリケーションの使用方法**  

### **1. Import a CSV File | CSV ファイルのインポート**  
- Navigate to the **Import CSV** tab and upload your file.  
- **Import CSV** タブを開き、CSV ファイルをアップロードしてください。  

### **2. Search for Population Data | 人口データの検索**  
- Select the **prefecture** and **year**, then click **Search**.  
- **都道府県** と **年** を選択し、**検索** をクリックしてください。  
