
<div class="row" style="padding:0 2rem;">

</div>
<div class="row justify-content-center">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <table class="table">
            <thead>
                <th>Client</th>
                <th>Service</th>
                <th>Location</th>
                <th>Description</th>
            </thead>
            <tbody>
                <?php
                    require_once '../models/Requests.php';
                    $listings = (new RequestManager)
                        ->jobListings(null);

                    if($listings)
                    foreach($listings as $listing => $data)
                    {
                ?>
                        <tr>
                            <td><?= $data['client'] ?></td>
                            <td><?= $data['service'] ?></td>
                            <td><?= $data['address'] ?></td>
                            <td><?= $data['description'] ?></tr>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
