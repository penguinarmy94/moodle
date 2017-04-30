How to use:
Initiate any variables specific to your database in 'configs.php'
Run initiate_database.php for easy installation.
When initiating database with data, drop database before hand if there are any
	existing data since adding the new data will create inconsistencies throughout the tables

if want to install manually to see if there are any errors,
	the php files should be done ran in the following order.

1. 'dbCreae.php'	creates the first set of tables
2. 'dbUpdate.php'	creates second set of tables
3. 'dbUpdate2.php'	initiates all the tables with data to be used in the system

if one wants to drop the database, run actio 'drop' in initiate_database.php,
	or to see if there are any erros run 'dbClean.php'