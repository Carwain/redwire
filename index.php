<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Song+Myung" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./themes/css/styles.css">
</head>

<body>
    <?php
        $monfichier = fopen('./graph/DHCP/fichier.txt', 'r+');
        $count_line = 0;
        $p = 0;
        while (!feof($monfichier)) {
            $ligne = fgets($monfichier);
            $graph['nodes'][$count_line] = array(
                'name'=>'VLAN'+$count_line,
                'label'=>$ligne,
                'id'=>$count_line
            );
            $count_line += 1;
        }
        for ($k=0; $k<=$count_line*$count_line;$k++){
            $tab_count[$k]='';
        }
        for ($j=0; $j<=$count_line; $j++) {
            for ($h=0;$h<=$count_line;$h++){
                $count = $j+$h;
                if($j!=$h){
                    for($i=0;$i<=$count_line*$count_line;$i++){
                        if($tab_count[$i]!=$count){
                            $graph['links'][$p] = array(
                                "source"=> $j,
                                "target"=> $h,
                                "type"=> ""
                            );
                            $tab_count[$i]=$count;
                        }
                    }
                }
                $p += 1;
            }
        }
        fclose($monfichier);
        $fp = fopen('./graph/results.json', 'w');
        fwrite($fp, json_encode($graph));
        fclose($fp)
    ?>
    <div>
        <h1>Bienvenue chez RED SPIDER NETWORK</h1>
    </div>
    <div class="inline">
        <svg id="svg" width="600" height="400"></svg>
    </div>
    <div class="inline2">
        <p>
            Visualiser votre infrastructure et l'intéraction entre chaque VLAN.<br>
            Chaque noeuds reprèsente un VLAN avec son nom et son adresse IP.<br>
            Chaque connexion et représenté par un lien connectant 2 VLAN entre eux.
        </p>
        <form action="./config/downloadFile.php" method="post">
            <input type="submit" name="submit" value="DDL GRAPH" />
        </form>
    </div>

    <script src="http://d3js.org/d3.v4.min.js" type="text/javascript"></script>
    <script src="http://d3js.org/d3-selection-multi.v1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="./themes/js/script.js"></script>

</body>

</html>