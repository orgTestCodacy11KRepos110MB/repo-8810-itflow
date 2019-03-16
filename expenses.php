<?php include("header.php"); ?>

<?php 
 
  $sql = mysqli_query($mysqli,"SELECT * FROM expenses, categories, vendors, accounts
    WHERE expenses.category_id = categories.category_id
    AND expenses.vendor_id = vendors.vendor_id
    AND expenses.account_id = accounts.account_id
    ORDER BY expenses.expense_date DESC");
?>

<div class="card mb-3">
  <div class="card-header">
    <h6 class="float-left mt-1"><i class="fa fa-money"></i> Expenses</h6>
    <button type="button" class="btn btn-primary btn-sm mr-auto float-right" data-toggle="modal" data-target="#addExpenseModal"><i class="fas fa-plus"></i> Add New</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-borderless table-hover" id="dT" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Date</th>
            <th class="text-right">Amount</th>
            <th>Vendor</th>
            <th>Category</th>
            <th>Account</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
      
          while($row = mysqli_fetch_array($sql)){
            $expense_id = $row['expense_id'];
            $expense_date = $row['expense_date'];
            $expense_amount = $row['expense_amount'];
            $expense_description = $row['expense_description'];
            $vendor_id = $row['vendor_id'];
            $vendor_name = $row['vendor_name'];
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];
            $account_name = $row['account_name'];
            $account_id = $row['account_id'];

          ?>

          <tr>
            <td><?php echo "$expense_date - $expense_id"; ?></td>
            <td class="text-right text-monospace">$<?php echo "$expense_amount"; ?></td>
            <td><?php echo "$vendor_name"; ?></td>
            <td><?php echo "$category_name"; ?></td>
            <td><?php echo "$account_name"; ?></td>
            <td>
              <div class="dropdown dropleft text-center">
                <button class="btn btn-secondary btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editExpenseModal<?php echo $expense_id; ?>">Edit</a>
                  <a class="dropdown-item" href="#">Duplicate</a>
                  <a class="dropdown-item" href="#">Refund</a>
                  <a class="dropdown-item" href="#">Delete</a>
                </div>
              </div>      
            </td>
          </tr>

          <?php

          include("edit_expense_modal.php");
          }

          ?>

        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

<?php include("add_expense_modal.php"); ?>

<?php include("footer.php");