<?php

return array(
	# Account credentials from developer portal
	'Account' => array(
		'ClientId' => 'AbcNrcE30ritwXSfQSYIoYBz3nCs9st_9V97Y61UoyddMEd2PVLX32xiNqzyVQA6bodSoI5_keYSgsK2',
		'ClientSecret' => 'EPJC2BJ5yc-2saMWWCBWYr3D_263E22lATrRte22gbNPtthNt49HOR6YBqKTYm_Fm9nWnt5BS6Z5jS5h',
	),

	# Connection Information
	'Http' => array(
		'ConnectionTimeOut' => 30,
		'Retry' => 1,
		//'Proxy' => 'http://[username:password]@hostname[:port][/path]',
	),

	# Service Configuration
	'Service' => array(
		# For integrating with the live endpoint,
		# change the URL to https://api.paypal.com!
		'EndPoint' => 'https://api.sandbox.paypal.com',
	),


	# Logging Information
	'Log' => array(
		'LogEnabled' => true,

		# When using a relative path, the log file is created
		# relative to the .php file that is the entry point
		# for this request. You can also provide an absolute
		# path here
		'FileName' => '../PayPal.log',

		# Logging level can be one of FINE, INFO, WARN or ERROR
		# Logging is most verbose in the 'FINE' level and
		# decreases as you proceed towards ERROR
		'LogLevel' => 'FINE',
	),
);
