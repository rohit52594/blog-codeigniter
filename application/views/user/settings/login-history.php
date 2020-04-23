<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Operating system</th>
        <th>Browser</th>
        <th>Remote address</th>
        <th>Logged in on</th>
      </tr>
      </thead>
      <tbody>
      <?php

        $i = 0;

      foreach ($LOGIN_DETAILS as $log) {


      ?>
          <tr>
            <td><?php echo ++$i; ?></td>
            <td><?php echo $log->os; ?></td>
            <td><?php echo $log->browser; ?></td>
            <td><?php echo $log->ip; ?></td>
            <td><?php echo $log->login_date . ' / ' . $log->login_time; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>