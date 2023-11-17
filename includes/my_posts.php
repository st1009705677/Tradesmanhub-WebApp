<div class="row">
    <div class="job-filters-options w-75">
        <div class="form-group">
            <select name="status" class="form-control col-4" placeholder="Status">
                <option selected value="">Status</option>
                <option value="Pending">Pending</option>
                <option value="cancelled">Cancelled</option>
                <option value="completed">Completed</option>
            </select>
        </div>
    </div>
    <a href="add-post.php" class="btn btn-outline-info" style="height:2.5rem;">New Job Post</a>
</div>

<div class="row">
    <?php
        require_once '../models/Requests.php';

        $uid = $_SESSION['logged_in_user'];

        $records = (new RequestManager)
            ->getPosts($uid);
        
            if(!empty($records)){
                foreach($records as $id => $data){
    ?>
                
                    <div class="card search_item_result jobs-item" style="background-color:#fff !important;">
                        <div class="item-menu-bar">
                            <h6><strong><?=$data['receipt_no']?></strong><h6>
                            <div class="">
                                <a href="#" alt="open"><i class="ri-window-2-line"></i></a>
                            </div>
                            
                        </div>
                        <div class=" w-100 item-body">
                            <div class="job-reference">
                                <div><i class="ri-circle-fill" style="<?php echo ($data['status'] == 'pending') ? 'color:orange;' : (($data['status'] == 'cancelled') ? 'color:red;' : 'color:green;');?>">&ensp;</i><?=ucfirst($data['status'])?></div>
                                <div style="padding-right:2rem;"><?php echo $data['start_date']; ?></div>
                            </div>
                            <h5><?=$data['provider']?> <span class="lead"><?php echo ($data['provider']) ? ' ('.$data['service'].')' : $data['service']; ?></span></h5>
                            <p><?=$data['description'] ?></p>
                        </div>
                    </div>
                
    <?php 
                }
            }
            
    ?>
</div>
<div class="card details-view">
    Hello, This is where the content should be
</div>


<script>
  
</script>