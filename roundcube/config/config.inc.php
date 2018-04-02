<?php

/* Local configuration for Roundcube Webmail */

// ----------------------------------
// SQL DATABASE
// ----------------------------------
// Database connection string (DSN) for read+write operations
// Format (compatible with PEAR MDB2): db_provider://user:password@host/database
// Currently supported db_providers: mysql, pgsql, sqlite, mssql or sqlsrv
// For examples see http://pear.php.net/manual/en/package.database.mdb2.intro-dsn.php
// NOTE: for SQLite use absolute path: 'sqlite:////full/path/to/sqlite.db?mode=0646'
#$config['db_dsnw'] = 'mysql://roundcube:roundcube@mydb/roundcubemail';
$config['db_dsnw'] = 'sqlite:////var/www/html/db/sqlite.db?mode=0646';

// ----------------------------------
// IMAP
// ----------------------------------
// The mail host chosen to perform the log-in.
// Leave blank to show a textbox at login, give a list of hosts
// to display a pulldown menu or set one host as string.
// To use SSL/TLS connection, enter hostname with prefix ssl:// or tls://
// Supported replacement variables:
// %n - hostname ($_SERVER['SERVER_NAME'])
// %t - hostname without the first part
// %d - domain (http hostname $_SERVER['HTTP_HOST'] without the first part)
// %s - domain name after the '@' from e-mail address provided at login screen
// For example %n = mail.domain.tld, %t = domain.tld
// WARNING: After hostname change update of mail_host column in users table is
//          required to match old user data records with the new host.
$config['default_host'] = 'ssl://imap.dataprev.gov.br';

// https://bbs.archlinux.org/viewtopic.php?id=187063
$config['imap_conn_options'] = array(
 'ssl'         => array(
     'verify_peer'       => false,
     'verfify_peer_name' => false,
  ),
);
$config['smtp_conn_options'] = array(
  'ssl'         => array(
      'verify_peer'      => false,
      'verify_peer_name' => false,
  ),
);

// provide an URL where a user can get support for this Roundcube installation
// PLEASE DO NOT LINK TO THE ROUNDCUBE.NET WEBSITE HERE!
$config['support_url'] = 'http://www-wiki/';

// this key is used to encrypt the users imap password which is stored
// in the session record (and the client cookie if remember password is enabled).
// please provide a string of exactly 24 chars.
$config['des_key'] = '*9r9m%*dPATZu8eVLi*MS_5i';

// ----------------------------------
// PLUGINS
// ----------------------------------
// List of active plugins (in plugins/ directory)
$config['plugins'] = array(
#'acl',
'additional_message_headers',
'archive',
'attachment_position',
'attachment_reminder',
#'calendar',
'contextmenu',
'contextmenu_folder',
#'hide_blockquote',
'infinitescroll',
'markasjunk',
'message_highlight',
'piwik_analytics',
#'tasklist',
'thunderbird_labels',
#'zipdownload',
);

// the default locale setting (leave empty for auto-detection)
// RFC1766 formatted language name like en_US, de_DE, de_CH, fr_FR, pt_BR
$config['language'] = 'pt_BR';

// Configurações Particulares - DATAPREV/INSS

// ----------------------------------
// IMAP
// ----------------------------------

$config['default_host'] = array(
	'ssl://imap.dataprev.gov.br'	=> 'DATAPREV.GOV.BR',
	'ssl://imap.inss.gov.br' => 'INSS.GOV.BR',
	'ssl://imap.funpresp.com.br' => 'FUNPRESP.COM.BR',
	);

$config['default_port'] = 993;

// ----------------------------------
// SMTP
// ----------------------------------

$config['smtp_server'] = 'ssl://smtp.%z';
#$config['smtp_server'] = 'ssl://smtp.dataprev.gov.br';

$config['smtp_port'] = 465;

$config['smtp_user'] = '%u';

$config['smtp_pass'] = '%p';

#$config['force_https'] = true;

// Allow browser-autocompletion on login form.
// 0 - disabled, 1 - username and host only, 2 - username, host, password
$config['login_autocomplete'] = 0;

$config['mail_domain'] = array(
	'imap.dataprev.gov.br'	=> 'dataprev.gov.br',
	'imap.inss.gov.br' => 'inss.gov.br',
	'imap.funpresp.com.br' => 'funpresp.com.br',
	);

// ----------------------------------
// ADDRESSBOOK SETTINGS
// ----------------------------------
$config['autocomplete_addressbooks'] = array('sql', 'OpenLDAP');

$config['autocomplete_min_length'] = 3;

//$config['ldap_debug'] = true;

$config['ldap_public']['OpenLDAP'] = array(
  'name'          => 'Catalogo Geral',
  // Replacement variables supported in host names:
  // %h - user's IMAP hostname
  // %n - hostname ($_SERVER['SERVER_NAME'])
  // %t - hostname without the first part
  // %d - domain (http hostname $_SERVER['HTTP_HOST'] without the first part)
  // %z - IMAP domain (IMAP hostname without the first part)
  // For example %n = mail.domain.tld, %t = domain.tld
  'hosts'         => array('ldap.dataprev.gov.br'),
  'port'          => 389,
  'use_tls'	  => true,
  'ldap_version'  => 3,       // using LDAPv3
  'network_timeout' => 10,    // The timeout (in seconds) for connect + bind arrempts. This is only supported in PHP >= 5.3.0 with OpenLDAP 2.x
  'user_specific' => false,   // If true the base_dn, bind_dn and bind_pass default to the user's IMAP login.
  // %fu - The full username provided, assumes the username is an email
  //       address, uses the username_domain value if not an email address.
  // %u  - The username prior to the '@'.
  // %d  - The domain name after the '@'.
  // %dc - The domain name hierarchal string e.g. "dc=test,dc=domain,dc=com"
  // %dn - DN found by ldap search when search_filter/search_base_dn are used
  'base_dn'       => 'dc=gov,dc=br',
  'bind_dn'       => 'uid=rcDTPUser,ou=Users,o=Builtin,dc=gov,dc=br',
  'bind_pass'     => 'rcDTPUserPWD',
  // It's possible to bind for an individual address book
  // The login name is used to search for the DN to bind with
  'search_base_dn' => 'dc=gov,dc=br',
  'search_filter'  => '(&(|(ou:dn:=DATAPREV)(ou:dn:=INSS)(ou:dn:=FUNPRESP))(objectClass=posixAccount)(uid=%u))',
  // DN and password to bind as before searching for bind DN, if anonymous search is not allowed
  'search_bind_dn' => '',
  'search_bind_pw' => '',
  // Default for %dn variable if search doesn't return DN value
  'search_dn_default' => '',
  // Optional authentication identifier to be used as SASL authorization proxy
  // bind_dn need to be empty
  'auth_cid'       => '',
  // SASL authentication method (for proxy auth), e.g. DIGEST-MD5
  'auth_method'    => '',
  // Indicates if the addressbook shall be hidden from the list.
  // With this option enabled you can still search/view contacts.
  'hidden'        => false,
  // Indicates if the addressbook shall not list contacts but only allows searching.
  'searchonly'    => false,
  // Indicates if we can write to the LDAP directory or not.
  // If writable is true then these fields need to be populated:
  // LDAP_Object_Classes, required_fields, LDAP_rdn
  'writable'       => false,
  // To create a new contact these are the object classes to specify
  // (or any other classes you wish to use).
  'LDAP_Object_Classes' => array('top', 'inetOrgPerson'),
  // The RDN field that is used for new entries, this field needs
  // to be one of the search_fields, the base of base_dn is appended
  // to the RDN to insert into the LDAP directory.
  'LDAP_rdn'       => 'mail',
  // The required fields needed to build a new contact as required by
  // the object classes (can include additional fields not required by the object classes).
  'required_fields' => array('uid', 'cn', 'sn', 'mail'),
  'search_fields'   => array('mail', 'cn'),  // fields to search in
  // mapping of contact fields to directory attributes
  //   for every attribute one can specify the number of values (limit) allowed.
  //   default is 1, a wildcard * means unlimited
  'fieldmap' => array(
    // Roundcube  => LDAP:limit
    'name'        => 'cn',
    'surname'     => 'sn',
    'firstname'   => 'givenName',
    'jobtitle'    => 'title',
    'email'       => 'mail:*',
    'phone:home'  => 'homePhone',
    'phone:work'  => 'telephoneNumber',
    'phone:mobile' => 'mobile',
    'phone:pager' => 'pager',
    'street'      => 'street',
    'zipcode'     => 'postalCode',
    'region'      => 'st',
    'locality'    => 'l',
    // if you country is a complex object, you need to configure 'sub_fields' below
    'country'      => 'c',
    'organization' => 'o',
    'department'   => 'ou',
    'jobtitle'     => 'title',
    'notes'        => 'description',
    // these currently don't work:
    // 'phone:workfax' => 'facsimileTelephoneNumber',
    // 'photo'         => 'jpegPhoto',
    // 'manager'       => 'manager',
    // 'assistant'     => 'secretary',
  ),
  // Map of contact sub-objects (attribute name => objectClass(es)), e.g. 'c' => 'country'
  'sub_fields' => array(),
  // Generate values for the following LDAP attributes automatically when creating a new record
  'autovalues' => array(
  // 'uid'  => 'md5(microtime())',               // You may specify PHP code snippets which are then eval'ed
  // 'mail' => '{givenname}.{sn}@mydomain.com',  // or composite strings with placeholders for existing attributes
  ),
  'sort'          => 'cn',    // The field to sort the listing by.
  'scope'         => 'sub',   // search mode: sub|base|list
  'filter'        => '(&(|(ou:dn:=DATAPREV)(ou:dn:=INSS)(ou:dn:=FUNPRESP))(objectClass=inetOrgPerson))',      // used for basic listing (if not empty) and will be &'d with search queries. example: status=act
  'fuzzy_search'  => true,    // server allows wildcard search
  'vlv'           => false,   // Enable Virtual List View to more efficiently fetch paginated data (if server supports it)
  'numsub_filter' => '(objectClass=organizationalUnit)',   // with VLV, we also use numSubOrdinates to query the total number of records. Set this filter to get all numSubOrdinates attributes for counting
  'sizelimit'     => '0',     // Enables you to limit the count of entries fetched. Setting this to 0 means no limit.
  'timelimit'     => '0',     // Sets the number of seconds how long is spend on the search. Setting this to 0 means no limit.
  'referrals'     => true|false,  // Sets the LDAP_OPT_REFERRALS option. Mostly used in multi-domain Active Directory setups

  // definition for contact groups (uncomment if no groups are supported)
  // for the groups base_dn, the user replacements %fu, %u, $d and %dc work as for base_dn (see above)
  // if the groups base_dn is empty, the contact base_dn is used for the groups as well
  // -> in this case, assure that groups and contacts are separated due to the concernig filters!

  'groups'        => array(
    'base_dn'     => 'dc=gov,dc=br',
    'scope'       => 'sub',   // search mode: sub|base|list
    'filter'      => '(objectClass=groupOfNames)',
    'object_classes' => array('top', 'groupOfNames'),
    'member_attr'  => 'member',   // name of the member attribute, e.g. uniqueMember
    'name_attr'    => 'cn',       // attribute to be used as group name
  ),


);


// ----------------------------------
// LOGGING/DEBUGGING
// ----------------------------------

// system error reporting, sum of: 1 = log; 4 = show
$config['debug_level'] = 5;

// log driver:  'syslog' or 'file'.
$config['log_driver'] = 'file';

// date format for log entries
// (read http://php.net/manual/en/function.date.php for all format characters)
$config['log_date_format'] = 'd-M-Y H:i:s O';

// length of the session ID to prepend each log line with
// set to 0 to avoid session IDs being logged.
$config['log_session_id'] = 8;

// Syslog ident string to use, if using the 'syslog' log driver.
$config['syslog_id'] = 'roundcube';

// Syslog facility to use, if using the 'syslog' log driver.
// For possible values see installer or http://php.net/manual/en/function.openlog.php
$config['syslog_facility'] = LOG_USER;

// Activate this option if logs should be written to per-user directories.
// Data will only be logged if a directry <log_dir>/<username>/ exists and is writable.
$config['per_user_logging'] = false;

// Log sent messages to <log_dir>/sendmail or to syslog
$config['smtp_log'] = true;

// Log successful/failed logins to <log_dir>/userlogins or to syslog
$config['log_logins'] = false;

// Log session authentication errors to <log_dir>/session or to syslog
$config['log_session'] = false;

// Log SQL queries to <log_dir>/sql or to syslog
$config['sql_debug'] = false;

// Log IMAP conversation to <log_dir>/imap or to syslog
$config['imap_debug'] = false;

// Log LDAP conversation to <log_dir>/ldap or to syslog
$config['ldap_debug'] = false;

// Log SMTP conversation to <log_dir>/smtp or to syslog
$config['smtp_debug'] = false;

// Log Memcache conversation to <log_dir>/memcache or to syslog
$config['memcache_debug'] = false;

// Log APC conversation to <log_dir>/apc or to syslog
$config['apc_debug'] = false;

// skin name: folder from skins/
$config['skin'] = 'mabola-blue';

// Name your service. This is displayed on the login screen and in the window title
$config['product_name'] = 'ExpressoRC - Dataprev';

// Set identities access level:
// 0 - many identities with possibility to edit all params
// 1 - many identities with possibility to edit all params but not email address
// 2 - one identity with possibility to edit all params
// 3 - one identity with possibility to edit all params but not email address
// 4 - one identity with possibility to edit only signature
$config['identities_level'] = 0;


// ----------------------------------
// Plugins configuration
// ----------------------------------

// Zipdownloads
$config['zipdownload_selection'] = false;

// Piwik
$rcmail_config = array (
  'piwik_analytics_id' => 48,
  'piwik_analytics_url' => 'estatisticasweb.dataprev.gov.br',
  'piwik_analytics_privacy' => false,
);


// end of config file
