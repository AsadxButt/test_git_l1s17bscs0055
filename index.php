<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join Pak Army</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body id="home">
<nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
        <a href="index.php" class="navbar-brand">
            <img src="img/army-logo" width="50" height="50" alt=""><h3 class="d-inline align-middle"> Join Pak Army </h3>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="#showcase" class="nav-link">Candidates</a>
                </li>
                <li class="nav-item">
                    <a href="#join" class="nav-link">Join</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- JOIN -->
<section id="join" class="bg-light py-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-9">
                <h3>Filter Eligible Candidates </h3>
                <p class="lead">JOIN PAK ARMY AS CAPTAIN THROUGH DIRECT SHORT SERVICE COMMISSION</p>
                <form action="" method="post">
                    <div class="form-row">
                        <div class="col-md-12">
                            <textarea class="form-control"
                                      placeholder="Copy students data from 'data.txt' file and paste here to filter ..."
                                      id="data" name="data" rows="16"></textarea>
                        </div>
                    </div>
                    <input type="submit" value="Filter" id="filter" name="filter" class="btn btn-dark btn-block btn-lg">
                </form>
            </div>
            <div class="col-lg-3 d-none d-lg-block align-self-center">
                <img src="img/army.png" alt="Army" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<section id="showcase" class="py-5">
    <div class="primary-overlay text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 text-center offset-lg-1">
                    <h4 class="display-4 mt-5">
                        Eligible Candidates List
                    </h4>
                    <p class="lead"></p>
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <td> Name </td>
                            <td> Reg# </td>
                            <td> CGPA </td>
                            <td> Dob </td>
                            <td> Height </td>
                            <td> Actions </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($_POST['filter'])){
                            $data = $_POST['data'];
                            $pattern = "/\d+\s([A-Z]+((\.|\s|\.\s|-)[A-Z]+)*)\s(L1(F|S)\d{2}BSCS\d{4})\s(([3-4]{1})|([2]{1}\.[5-9]\d{0,1})|([3]\.\d{1,2})|[4]\.[0]{1,2})\s((0?[1-9]|[1-2]\d|3[01])\/(0?[1-9]|1[0-2])\/19(8[9]|9\d))\s(5\^(0?[3-9]|1[0-2])|6(\^(0?[1-9]|1[0-2]))?|7(\^0)?)\s/";
                            if(preg_match_all($pattern, $data, $matches_out))
                            {
                                for($i=0;$i<count($matches_out[1]);$i++){
                                    ?>
                                    <tr>
                                        <td><?php echo $matches_out[1][$i]?></td>
                                        <td><?php echo $matches_out[4][$i]?></td>
                                        <td><?php echo $matches_out[6][$i]?></td>
                                        <td><?php echo $matches_out[10][$i]?></td>
                                        <td><?php echo str_replace('^','\'',$matches_out[14][$i])?></td>
                                        <td><input type="button"
                                                   id="apply<?php echo $matches_out[4][$i];?>"
                                                   class="btn btn-dark"
                                                   value="Apply"
                                                   onclick="apply(
                                                        '<?php echo $matches_out[1][$i];?>',
                                                        '<?php echo $matches_out[4][$i];?>',
                                                        '<?php echo $matches_out[6][$i];?>',
                                                        '<?php echo $matches_out[10][$i];?>',
                                                        '<?php echo $matches_out[14][$i];?>')">
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<footer id="main-footer" class="py-3 bg-primary text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 ml-auto">
                <p class="lead">Copyright &copy; 2019</p>
            </div>
        </div>
    </div>
</footer>
<script>
    function apply(name, reg, cgpa, dob, height){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('apply'+reg).value = this.responseText;
                    document.getElementById('apply'+reg).classList.remove('btn-dark');
                    document.getElementById('apply'+reg).classList.add('btn-warning');
                }
            };
            xhttp.open("GET", "apply.php?name="+name+"&reg="+reg+"&cgpa="+cgpa+"&dob="+dob+"&height="+height);
            xhttp.send();
    }
</script>
</body>
</html>