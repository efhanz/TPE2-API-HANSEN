{include file="header.tpl"}

<div class="container">

  <h1 class="my-4 d-flex justify-content-center">{$titulo}</h1>

  <table class="table">
    <thead>
      <tr>
        <th scope="col"> Transaction_ID</th>
        <th scope="col"> Customer</th>
        <th scope="col"> Product</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{$sale->Transaction_ID}</td>
        <td>{$sale->Customer}</td>
        <td>{$sale->Product}</td>
      </tr>
    </tbody>
  </table>


  <div class="container">
    <ul class="list-group">
      <li class="list-group-item">Invoice#: {$sale->Invoice}</li>
      <li class="list-group-item">Date: {$sale->Date}</li>
      <li class="list-group-item">Seller: {$sale->Seller}</li>
      <li class="list-group-item">Quantity: {$sale->Quantity}</li>
      <li class="list-group-item">Unit_Price: {$sale->Unit_Price}</li>
      <li class="list-group-item">Amount: {$sale->Amount}</li>
    </ul>

  </div>

  <div class="container text-center btn-group">
    {if isset($smarty.session.user_ID)}
      <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown"
        aria-expanded="true">
        - UPDATE THE SALE (if you're sure)-
    </button>
    <div class="dropdown-menu dropdown-menu-dark dropdown dropdown-menu-end dropdown-menu-lg-start">Select the field to
      change and update it
      <form class="row gx-3 gy-2 align-items-center container dropdown-menu-end "
        action="updateSale/{$sale->Transaction_ID}" method="post">
        <div class="col-sm-3">


          <label>Customer</label><input type="text" name="customer" value="{$sale->Customer}" class="form-control"
            id="specificSizeInputName" placeholder="Customer" required>
        </div>
        <div class="col-sm-3">
          <label>Invoice #</label><input type="text" name="invoice" value="{$sale->Invoice}" class="form-control"
            id="specificSizeInputName" placeholder="Invoice #" required>
        </div>
        <div class="col-sm-3">
          <label>Date</label><input type="date" name="dates" value="{$sale->Date}" class="form-control"
            id="specificSizeInputName" placeholder="Date" required>
        </div>
        <div class="col-sm-3">
          <label for="specificSizeSelect">Seller</label>
          <select type="number" class="form-select" id="priority" name="seller" value="{$sale->Seller}" required>
            {foreach from=$sellers item=$seller}
            <option value='{$seller->Seller_ID}'>{$seller->Seller_ID} - {$seller->Seller}</option>
              {/foreach}

            </select>
          </div>
          <div class="col-sm-3">
            <label>Product</label><input type="text" name="product" value="{$sale->Product}" class="form-control"
              id="specificSizeInputName" placeholder="Product" required>
          </div>
          <div class="col-sm-3">
            <label>Quantity</label><input type="number" name="quantity" value="{$sale->Quantity}" class="form-control"
              id="specificSizeInputName" placeholder="Quantity" required>
          </div>
          <div class="col-sm-3">
            <label>Unit_Price</label><input type="number" name="unitprice" value="{$sale->Unit_Price}"
              class="form-control" id="specificSizeInputName" placeholder="Unit_Price" required>
          </div>
          <div class="col-sm-3">
            <label>Amount</label><input type="number" name="amount" class="form-control" value="{$sale->Amount}"
              id="specificSizeInputName" placeholder="Amount" required>
          </div>

          <div class="col-auto">
            <input type="submit" class="btn btn-dark" value="EDIT">
          </div>
        </form>

      </div>
    {/if}
  </div>
  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button class="btn btn-outline-secondary"><a class="btn btn-secondary" href="showSales">Return</a></button>
    <button class="btn btn-outline-secondary"><a class="btn btn-secondary" href="home">Home</a></button>
  </div>


</div>


{include file="footer.tpl"}