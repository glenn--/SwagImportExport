<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Tests\Functional\Commands;

use Doctrine\DBAL\Connection;
use SwagImportExport\Tests\Helper\DataProvider\ProfileDataProvider;
use Tests\Helper\CommandTestHelper;

class ImportCommandTest extends \Enlight_Components_Test_Plugin_TestCase
{
    /**
     * @var CommandTestHelper
     */
    private $commandTestHelper;

    /**
     * @var Connection
     */
    private $connection;

    public function setUp()
    {
        $this->commandTestHelper = Shopware()->Container()->get('swag_import_export.tests.command_test_helper');
        $this->commandTestHelper->setUp();
        $this->connection = Shopware()->Container()->get('dbal_connection');
    }

    protected function tearDown()
    {
        $this->commandTestHelper->tearDown();
    }

    public function testCustomerXmlImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::CUSTOMER_TABLE);
        $customerProfileName = ProfileDataProvider::CUSTOMER_PROFILE_NAME;
        $importFilePath = CommandTestHelper::IMPORT_FILES_DIR . 'CustomerImport.xml';
        $expectedImportedCustomersAmount = 4;

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$customerProfileName} {$importFilePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::CUSTOMER_TABLE);
        $importedCustomersAmount = $resultLineAmount - $actualLineAmount;

        $this->assertEquals('Using profile: customer_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: xml.', $consoleOutput[1]);
        $this->assertEquals("Total count: {$expectedImportedCustomersAmount}.", $consoleOutput[3]);
        $this->assertEquals($expectedImportedCustomersAmount, $importedCustomersAmount);
    }

    public function testCustomerCsvImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::CUSTOMER_TABLE);
        $customerProfileName = ProfileDataProvider::CUSTOMER_PROFILE_NAME;
        $importFilePath = CommandTestHelper::IMPORT_FILES_DIR . 'CustomerImport.csv';
        $expectedImportedCustomersAmount = 4;

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$customerProfileName} {$importFilePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::CUSTOMER_TABLE);
        $importedCustomersAmount = $resultLineAmount - $actualLineAmount;

        $this->assertEquals('Using profile: customer_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: csv.', $consoleOutput[1]);
        $this->assertEquals("Total count: {$expectedImportedCustomersAmount}.", $consoleOutput[3]);
        $this->assertEquals($expectedImportedCustomersAmount, $importedCustomersAmount);
    }

    public function testCategoryXmlImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::CATEGORY_TABLE);
        $categoryProfileName = ProfileDataProvider::CATEGORY_PROFILE_NAME;
        $importFilePath = CommandTestHelper::IMPORT_FILES_DIR . 'CategoriesImport.xml';
        $expectedImportedCategories = 16;

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$categoryProfileName} {$importFilePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::CATEGORY_TABLE);
        $importedCategoriesAmount = $resultLineAmount - $actualLineAmount;

        $this->assertEquals('Using profile: category_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: xml.', $consoleOutput[1]);
        $this->assertEquals("Total count: {$expectedImportedCategories}.", $consoleOutput[3]);
        $this->assertEquals($expectedImportedCategories, $importedCategoriesAmount);
    }

    public function testCategoryCsvImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::CATEGORY_TABLE);
        $profile = ProfileDataProvider::CATEGORY_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'CategoriesImport.csv';
        $expectedImportedCategories = 16;

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::CATEGORY_TABLE);
        $importedCategoriesAmount = $resultLineAmount - $actualLineAmount;

        $this->assertEquals('Using profile: category_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: csv.', $consoleOutput[1]);
        $this->assertEquals("Total count: {$expectedImportedCategories}.", $consoleOutput[3]);
        $this->assertEquals($expectedImportedCategories, $importedCategoriesAmount);
    }

    public function testNewsletterRecipientXmlImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::NEWSLETTER_TABLE);
        $profile = ProfileDataProvider::NEWSLETTER_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'NewsletterRecipientImport.xml';
        $expectedImportedNewsletterRecipients = 6;

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::NEWSLETTER_TABLE);
        $importedNewsletterAmount = $resultLineAmount - $actualLineAmount;

        $this->assertEquals('Using profile: newsletter_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: xml.', $consoleOutput[1]);
        $this->assertEquals("Total count: {$expectedImportedNewsletterRecipients}.", $consoleOutput[3]);
        $this->assertEquals($expectedImportedNewsletterRecipients, $importedNewsletterAmount);
    }

    public function testNewsletterRecipientCsvImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::NEWSLETTER_TABLE);
        $profile = ProfileDataProvider::NEWSLETTER_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'NewsletterRecipientImport.csv';
        $expectedImportedNewsletterRecipients = 6;

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::NEWSLETTER_TABLE);
        $importedNewsletterAmount = $resultLineAmount - $actualLineAmount;

        $this->assertEquals('Using profile: newsletter_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: csv.', $consoleOutput[1]);
        $this->assertEquals("Total count: {$expectedImportedNewsletterRecipients}.", $consoleOutput[3]);
        $this->assertEquals($expectedImportedNewsletterRecipients, $importedNewsletterAmount);
    }

    public function testArticleXmlImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::ARTICLE_TABLE);
        $profile = ProfileDataProvider::ARTICLE_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'ArticleImport.xml';
        $expectedImportedArticles = 2;

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::ARTICLE_TABLE);
        $importedArticlesAmount = $resultLineAmount - $actualLineAmount;

        $this->assertEquals('Using profile: article_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: xml.', $consoleOutput[1]);
        $this->assertEquals("Total count: {$expectedImportedArticles}.", $consoleOutput[3]);
        $this->assertEquals($expectedImportedArticles, $importedArticlesAmount);
    }

    public function testArticleCsvImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::ARTICLE_TABLE);
        $profile = ProfileDataProvider::ARTICLE_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'ArticleImport.csv';
        $expectedImportedArticles = 2;

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::ARTICLE_TABLE);
        $importedArticlesAmount = $resultLineAmount - $actualLineAmount;

        $this->assertEquals('Using profile: article_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: csv.', $consoleOutput[1]);
        $this->assertEquals("Total count: {$expectedImportedArticles}.", $consoleOutput[3]);
        $this->assertEquals($expectedImportedArticles, $importedArticlesAmount);
    }

    public function testVariantXmlImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::VARIANT_TABLE);
        $profile = ProfileDataProvider::VARIANT_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'VariantsImport.xml';
        $expectedImportedVariants = 5;

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::VARIANT_TABLE);
        $importedVariantsAmount = $resultLineAmount - $actualLineAmount;

        $this->assertEquals('Using profile: variant_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: xml.', $consoleOutput[1]);
        $this->assertEquals("Total count: {$expectedImportedVariants}.", $consoleOutput[3]);
        $this->assertEquals($expectedImportedVariants, $importedVariantsAmount);
    }

    public function testVariantCsvImport()
    {
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::VARIANT_TABLE);
        $profile = ProfileDataProvider::VARIANT_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'VariantsImport.csv';
        $expectedImportedVariants = 5;

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::VARIANT_TABLE);
        $importedVariantsAmount = $resultLineAmount - $actualLineAmount;

        $this->assertEquals('Using profile: variant_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: csv.', $consoleOutput[1]);
        $this->assertEquals("Total count: {$expectedImportedVariants}.", $consoleOutput[3]);
        $this->assertEquals($expectedImportedVariants, $importedVariantsAmount);
    }

    public function testArticleInStockXmlImport()
    {
        $profile = ProfileDataProvider::ARTICLES_INSTOCK_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'ArticleInStockImport.xml';

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $this->assertEquals('Using profile: article_instock_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: xml.', $consoleOutput[1]);
        $this->assertEquals('Total count: 405.', $consoleOutput[3]);
    }

    public function testArticleInStockCsvImport()
    {
        $profile = ProfileDataProvider::ARTICLES_INSTOCK_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'ArticleInStockImport.csv';

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $this->assertEquals('Using profile: article_instock_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: csv.', $consoleOutput[1]);
        $this->assertEquals('Total count: 405.', $consoleOutput[3]);
    }

    public function testArticlePriceXmlImport()
    {
        $profile = ProfileDataProvider::ARTICLES_PRICES_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'ArticlePricesImport.xml';

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $this->assertEquals('Using profile: articles_price_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: xml.', $consoleOutput[1]);
        $this->assertEquals('Total count: 27.', $consoleOutput[3]);
    }

    public function testArticlePriceCsvImport()
    {
        $profile = ProfileDataProvider::ARTICLES_PRICES_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'ArticlePricesImport.csv';

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $this->assertEquals('Using profile: articles_price_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: csv.', $consoleOutput[1]);
        $this->assertEquals('Total count: 98.', $consoleOutput[3]);
    }

    public function testArticleTranslationXmlImport()
    {
        $profile = ProfileDataProvider::ARTICLES_TRANSLATIONS_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'ArticleTranslationImport.xml';

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $this->assertEquals('Using profile: articles_translations_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: xml.', $consoleOutput[1]);
        $this->assertEquals('Total count: 103.', $consoleOutput[3]);
    }

    public function testArticleTranslationCsvImport()
    {
        $profile = ProfileDataProvider::ARTICLES_TRANSLATIONS_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'ArticleTranslationImport.csv';

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $this->assertEquals('Using profile: articles_translations_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: csv.', $consoleOutput[1]);
        $this->assertEquals('Total count: 103.', $consoleOutput[3]);
    }

    public function testOrderXmlImport()
    {
        $profile = ProfileDataProvider::ORDERS_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'OrderImport.xml';
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::ORDER_TABLE);
        $expectedImportedOrders = 0;

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);
        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::ORDER_TABLE);
        $importedOrdersAmount = $resultLineAmount - $actualLineAmount;

        $this->assertEquals($expectedImportedOrders, $importedOrdersAmount);
        $this->assertEquals('Using profile: order_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: xml.', $consoleOutput[1]);
        $this->assertEquals('Total count: 17.', $consoleOutput[3]);
    }

    public function testOrderCsvImport()
    {
        $profile = ProfileDataProvider::ORDERS_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'OrderImport.csv';
        $actualLineAmount = $this->getRowCountForTable(ProfileDataProvider::ORDER_TABLE);
        $expectedImportedOrders = 0;

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);
        $resultLineAmount = $this->getRowCountForTable(ProfileDataProvider::ORDER_TABLE);
        $importedOrdersAmount = $resultLineAmount - $actualLineAmount;

        $this->assertEquals($expectedImportedOrders, $importedOrdersAmount);
        $this->assertEquals('Using profile: order_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: csv.', $consoleOutput[1]);
        $this->assertEquals('Total count: 17.', $consoleOutput[3]);
    }

    /**
     * @expectedException \Exception
     */
    public function testMainOrderXmlImport()
    {
        $profile = ProfileDataProvider::IMPORT_MAIN_ORDER_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'MainOrderImport.xml';

        $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
    }

    /**
     * @expectedException \Exception
     */
    public function testMainOrderCsvImport()
    {
        $profile = ProfileDataProvider::IMPORT_MAIN_ORDER_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'MainOrderImport.csv';

        $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
    }

    public function testTranslationXmlImport()
    {
        $profile = ProfileDataProvider::TRANSLATIONS_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'TranslationImport.xml';

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $this->assertEquals('Using profile: translation_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: xml.', $consoleOutput[1]);
        $this->assertEquals('Total count: 15.', $consoleOutput[3]);
    }

    public function testTranslationCsvImport()
    {
        $profile = ProfileDataProvider::TRANSLATIONS_PROFILE_NAME;
        $filePath = CommandTestHelper::IMPORT_FILES_DIR . 'TranslationImport.csv';

        $consoleOutput = $this->commandTestHelper->runCommand("sw:importexport:import -p {$profile} {$filePath}");
        $consoleOutput = $this->convertOutputToArrayByLineBreak($consoleOutput);

        $this->assertEquals('Using profile: translation_profile.', $consoleOutput[0]);
        $this->assertEquals('Using format: csv.', $consoleOutput[1]);
        $this->assertEquals('Total count: 15.', $consoleOutput[3]);
    }

    /**
     * @param string $consoleOutput
     * @return array
     */
    private function convertOutputToArrayByLineBreak($consoleOutput)
    {
        return explode(PHP_EOL, $consoleOutput);
    }

    /**
     * @param string $table
     * @return int
     */
    private function getRowCountForTable($table)
    {
        $statement = $this->connection->executeQuery("SELECT * FROM {$table}");
        return $statement->rowCount();
    }
}
