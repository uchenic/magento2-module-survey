<?php 
namespace Magento\Survey\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('survey_entity'))
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true,'unsigned'=>true],
                'Survey ID'
            )
            ->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => true], 'Survey Title')            
            ->setComment('Survey List');

        $installer->getConnection()->createTable($table);

        $table2 = $installer->getConnection()
            ->newTable($installer->getTable('survey_question'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true,'unsigned'=>true],
                'Question ID'
            )
            ->addColumn('question', Table::TYPE_TEXT, 1024, ['nullable' => true], 'Survey Title')
            ->addColumn('survey_id',Table::TYPE_INTEGER,null,['nullable' => false,'unsigned'=>true])
            ->addForeignKey('survey_question_key','survey_id','survey_entity','entity_id');

        $installer->getConnection()->createTable($table2);

        $table3 = $installer->getConnection()
            ->newTable($installer->getTable('survey_question_answer'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true,'unsigned'=>true],
                'Answer ID'
            )
            ->addColumn('answer', Table::TYPE_TEXT, 1024, ['nullable' => true], 'Survey Title')
            ->addColumn('question_id',Table::TYPE_INTEGER,null,['nullable' => false,'unsigned'=>true])
            ->addForeignKey('survey_question_answer_key','question_id','survey_question','id');

        $installer->getConnection()->createTable($table3);

         $table4 = $installer->getConnection()
            ->newTable($installer->getTable('survey_result'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true,'unsigned'=>true],
                'Result ID'
            )
            ->addColumn('answer_id',Table::TYPE_INTEGER,null,['nullable' => false,'unsigned'=>true])
            ->addColumn('question_id',Table::TYPE_INTEGER,null,['nullable' => false,'unsigned'=>true])
            ->addColumn('customer_id', Table::TYPE_INTEGER, 10, ['nullable' => false,'unsigned'=>true])
            ->addForeignKey('survey_question_answer_key_result','question_id','survey_question','id')
            ->addForeignKey('survey_question_key_result','answer_id','survey_question_answer','id')
            ->addForeignKey('survey_question_customer_entity_result','customer_id','customer_entity','entity_id');

        $installer->getConnection()->createTable($table4);

         $table5 = $installer->getConnection()
            ->newTable($installer->getTable('survey_user_map'))
            ->addColumn('customer_id', Table::TYPE_INTEGER, 10, ['nullable' => false,'unsigned'=>true])
            ->addForeignKey('survey_user_map_key','customer_id','customer_entity','entity_id')
            ->addColumn('hash', Table::TYPE_TEXT, 255, ['nullable' => true], 'User Hash')            
            ->setComment('Hash User Map');

        $installer->getConnection()->createTable($table5);

        

        $installer->endSetup();
    }

}
