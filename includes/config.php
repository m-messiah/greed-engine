<?php

  function db_connect()
  {
    global $db;
    $host = '';
    $login = '';
    $password = '';
    $dbname = '';
    $db = mysqli_connect($host, $login, $password, $dbname);
    if ($db->connect_errno)
        return view('error', array('message' => 'Can\'t connect to database'));
    $db->query('SET NAMES utf8');
    $db->query('SET SESSION time_zone = "+5:00"');
    return $db;
  }

  db_connect();


  function db_query($sql, $typeDef=false, $params=false)
  {
    global $db;

    $stmt = $db->prepare($sql);
    if (! $stmt)
      return view('error', array('message' => 'DB: Invalid statement'));

    if (count($params) == count($params, 1))
    {
      $params = array($params);
      $multiQuery = false;
    }
    else
      $multiQuery = true;

    if ($typeDef)
    {
      $bindParams = array();
      $bindParamsReferences = array();
      $bindParams = array_pad($bindParams, (count($params, 1) - count($params)) / count($params), "");
      foreach ($bindParams as $key => $value)
        $bindParamsReferences[$key] = &$bindParams[$key];
      array_unshift($bindParamsReferences, $typeDef);
      $bindParamsMethod = new ReflectionMethod('mysqli_stmt', 'bind_param');
      $bindParamsMethod->invokeArgs($stmt, $bindParamsReferences);
    }

    $result = array();
    foreach ($params as $queryKey => $query)
    {
      foreach ($bindParams as $paramKey => $value)
        $bindParams[$paramKey] = $query[$paramKey];
      $queryResult = array();

      if (mysqli_stmt_execute($stmt))
      {
        $resultMetaData = mysqli_stmt_result_metadata($stmt);
        if ($resultMetaData)
        {
          $stmtRow = array();
          $rowReferences = array();
          while ($field = mysqli_fetch_field($resultMetaData))
            $rowReferences[] = &$stmtRow[$field->name];
          mysqli_free_result($resultMetaData);
          $bindResultMethod = new ReflectionMethod('mysqli_stmt', 'bind_result');
          $bindResultMethod->invokeArgs($stmt, $rowReferences);
          while (mysqli_stmt_fetch($stmt))
          {
            $row = array();
            foreach($stmtRow as $key => $value)
              $row[$key] = $value;
            $queryResult[] = $row;
          }
          mysqli_stmt_free_result($stmt);
        }
        else
          $queryResult[] = mysqli_stmt_affected_rows($stmt);
      }
      else
      {
        echo $stmt->error;
        $queryResult[] = false;
      }
      $result[$queryKey] = $queryResult;
    }
    mysqli_stmt_close($stmt);

    return $multiQuery ? $result : $result[0];
  }
?>
