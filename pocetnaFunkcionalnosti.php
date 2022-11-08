<?php
    include('konekcija.php');

    if (isset($_POST['key'])) {

        if($_POST['key'] == 'ubaci'){
            
            $nar_id = $_POST['nar_id'];
            $naziv = $_POST['naziv'];
            $model = $_POST['model'];
            $godinaProizvodnje = $_POST['godina_proizvodnje'];
            $cena = $_POST['cena'];
            
            $check = mysqli_query($conn,"SELECT * FROM narukvice WHERE nar_id = '$nar_id'");
    
            if(mysqli_num_rows($check) > 0) {
                echo "Isti model narukvice " . $model . ", već postoji!";
            } else {
            
                $sql="INSERT INTO `narukvice` (`nar_id`,`naziv`, `model`, `godina_proizvodnje`,`cena`,`vlasnik_id`) VALUES ('$nar_id','$naziv', '$model', '$godinaProizvodnje', '$cena', 1)";
            
                if ($conn->query($sql) === TRUE) {
                    echo "Ubacen novi model narukvice!";
                }
                else 
                {
                    echo "Takav model narukvice vec postoji!";
                }
            }
        }


        if($_POST['key'] == 'ucitaj'){
    
            $start = $conn->real_escape_string($_POST['start']);
            $limit = $conn->real_escape_string($_POST['limit']);
            $sort = $conn->real_escape_string($_POST['sort']);
            $sql = $conn->query("SELECT nar_id, naziv, model, godina_proizvodnje, cena FROM narukvice ORDER BY $sort LIMIT $start, $limit");

            if ($sql->num_rows > 0) {
                $response = "";
                while($data = $sql->fetch_array()) {
    
                    $response .= '
                                <tr>
                                    <td id="narukvice_'.$data["nar_id"].'">'.$data["nar_id"].'</td>
                                    <td>'.$data["naziv"].'</td>
                                    <td>'.$data["model"].'</td>
                                    <td>'.$data["godina_proizvodnje"].'</td>
                                    <td>'.$data["cena"].'</td>
                                    <td>
                                        <input type="button" onclick="izmeniPogledaj('.$data["nar_id"].', \'izmeni\')" value="Izmeni" class="btn btn-primary">
                                        <input type="button" onclick="izmeniPogledaj('.$data["nar_id"].', \'pogledaj\')" value="Pogledaj" class="btn btn-warning">
                                        <input type="button" onclick="izbrisi('.$data["nar_id"].')" value="Izbriši" class="btn btn-danger">
                                    </td>
                                </tr>
                            ';
                    }
                    exit($response);
                    } else
                        exit('reachedMax');	
        }


        
        if ($_POST['key'] == 'izbrisi') {
            $nar_id = $conn->real_escape_string($_POST['nar_id']);
            $conn->query("DELETE FROM narukvice WHERE nar_id='$nar_id'");
            exit('Model narukvice obrisan!');
        }

        if($_POST['key'] == 'uzmiPodatke'){
            $nar_id = $conn->real_escape_string($_POST['nar_id']);
            $sql = $conn->query("SELECT nar_id , naziv, model, godina_proizvodnje, cena FROM narukvice WHERE nar_id = $nar_id");
            $data = $sql->fetch_array();
            $jsonArray = array(
                'nar_id'=>$data['nar_id'],
                'naziv'=>$data['naziv'],
                'model'=>$data['model'],
                'godina_proizvodnje'=>$data['godina_proizvodnje'],
                'cena'=>$data['cena']
            );
            exit(json_encode($jsonArray));
        }
            

        if ($_POST['key'] == 'izmeni') {

            $trenutni_red = $conn->real_escape_string($_POST['nar_id']);

                $nar_id = $_POST['nar_id'];
                $naziv = $_POST['naziv'];
                $model = $_POST['model'];
                $godina_proizvodnje=$_POST['godina_proizvodnje'];
                $cena=$_POST['cena'];
                
            
                $sql="UPDATE narukvice SET naziv='$naziv', model='$model', godina_proizvodnje='$godina_proizvodnje', cena='$cena' WHERE nar_id='$trenutni_red'";
                if ($conn->query($sql) === TRUE) {
                    echo "Uspešno izmenjena narukvica!";
                }
                else 
                {
                    echo "Narukvica nije izmenjena!";
                }
            
            }
        }
    
        mysqli_close($conn);
    
?>