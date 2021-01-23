<?php
require_once("../database/connection.php");
require_once("../database/curl_call.php");

if (!isset($_SESSION['id'])) {
    header('location:login.php');
}
$query="SELECT * from help_support";
$result = $pdo->prepare($query);
$result->execute();
$response = $result->fetchAll(PDO::FETCH_ASSOC);

$query = "select * from pincode";
$pincoderesult = $pdo->prepare($query);
$pincoderesult->execute();
$pincodelist = $pincoderesult->fetchAll(PDO::FETCH_ASSOC);

?>


<div>
    <section class="section">
        <div class="section-header">
            <h1>Help & Support</h1>
        </div>

        <div class="section-body">
            <div id="help" class="section-body">
                <div class="card">
                    <div class="card-header" style="display: block;">
                        
                    </div>


                    <div class="card-body">
                    <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2 cardedit">

                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <!-- <h4>Whatsapp</h4> -->
                        </div>
                        <div class="card-body">
                        <?php foreach($response as $row){ 
                            if($row['category']=='watsup'){    
                        ?>
                        <h5>+91 <?= $row['value']; ?></h5>
                        <?php } } ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2 cardedit">

                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-phone-volume fa-5x"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <!-- <h4>Call us </h4> -->
                        </div>
                        <div class="card-body">
                        <?php foreach($response as $row){ 
                            if($row['category']=='mobile'){    
                        ?>
                        <h5>+91 <?= $row['value']; ?></h5>
                        <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2 cardedit">

                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-envelope fa-lg"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <!-- <h4>Mail to</h4> -->
                        </div>
                        <div class="card-body">
                        <?php foreach($response as $row){ 
                            if($row['category']=='email'){    
                        ?>
                        <h5>    <?= $row['value']; ?></h5>
                        <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="row">

            <div class="col-md-3 col-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Active Pincodes</h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#pincodemodel">
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        
                        <div class="table-responsive tableFixHead">
                            <table class="table table-striped">
                                <tbody>
                                    <?php if (@$pincodelist == '') { ?>
                                        <tr>
                                            <td colspan="2">
                                                <label>NO DATA FOUND</label>
                                            </td>
                                        </tr>

                                    <?php   } else { ?>

                                        <?php foreach ($pincodelist as $row) { ?>
                                            <tr>
                                                <td contenteditable="true" class="pincodeedit" id="<?= @$row['id']; ?>" title="<?= @$row['pincode']; ?>">
                                                    <?= @$row['pincode']; ?>
                                                </td>
                                            </tr>
                                    <?php   }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Q&A</h4>
                    </div>
                    <div class="card-body p-4">
                       <div><h6 class="font-weight-bold"> Q1. how ?</h6></div>
                       <div>A1. this !</div>
                       <hr>
                       <div><h6 class="font-weight-bold"> Q1. how ?</h6></div>
                       <div>A1. this !</div>
                       <hr>
                       <div><h6 class="font-weight-bold"> Q1. how ?</h6></div>
                       <div>A1. this !</div>
                       <hr>
                    </div>
                </div>
            </div>
        </div>
