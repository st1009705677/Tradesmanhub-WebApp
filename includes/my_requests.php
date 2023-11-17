<div class="row">
    <table style="width:100%;">
        <tbody>
            <?php
                require_once '../models/Requests.php';

                $uid = $_SESSION['logged_in_user'];

                $records = (new RequestManager)
                    ->getRequests($uid);
                
                    if(!empty($records)){
                        foreach($records as $id => $data){
            ?>
                       <tr>
                            <div class="card w-100 jobs-item" style="background-color:#fff !important;">
                                <div class="item-menu-bar">
                                    <h6><strong><?=$data['id']?></strong><h6>
                                    <a href="#" class="menu-icon"><i class="ri-more-fill"></i></a>
                                </div>
                                <div class="item-body">
                                    <div class="job-reference">
                                        <div><i class="ri-circle-fill" style="<?php echo ($data['status'] == 'pending') ? 'color:orange;' : (($data['status'] == 'cancelled') ? 'color:red;' : 'color:green;');?>">&ensp;</i><?=ucfirst($data['status'])?></div>
                                        <div style="padding-right:2rem;">22-03-2023</div>
                                    </div>
                                    <h5><?=$data['name']?> <span class="lead">(<?=$data['service']?>)</span></h5>
                                </div>
                            </div>
                        </tr>
            <?php 
                        }
                    }
                    
            ?>

            
        </tbody>
    </table>
</div>