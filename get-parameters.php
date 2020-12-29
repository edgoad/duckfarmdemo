<?php
  # Retrieve settings from Parameter Store
  require 'aws-autoloader.php';

  $az = file_get_contents('http://169.254.169.254/latest/meta-data/placement/availability-zone');
  $region = substr($az, 0, -1);
  
  $ssm_client = new Aws\Ssm\SsmClient([
    'version' => 'latest',
    'region'  => $region
  ]);

  $result = $ssm_client->GetParametersByPath(['Path' => '/duckfarm/']);
    
  # Obtain shipping flag
  $show_debug = 'False';
  foreach($result['Parameters'] as $p) {
    if ($p['Name'] == '/duckfarm/show_debug')
      $show_debug = $p['Value'];
    }
  
?>