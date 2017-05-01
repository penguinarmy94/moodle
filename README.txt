How to set-up database:
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

How to use after setting-up database:
In the index.php, change the values of the $session_data. Look in the database to see a value 
for each of the results. To test default, leave the values that are already on there.

Uncomment one of the session_data blocks to get started with the defaults

If you want to use other values, use one of the blocks and change the values based on the values in the database as follows:

$session_data['first'] = (firstname column in user)
$session_data['last'] = (lastname column in user)
$session_data['user_role'] = (user_role column in user_authorization;
$session_data['major'] = (major_name column in major);
$session_data['user_name'] = (user_email column in user_credentials);
$session_data['user_id'] = (user_id in user);
