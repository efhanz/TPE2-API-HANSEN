{include file="header.tpl"}

<div class="container">
  <div class="row mt-4">
    <div class="col-md-4">
      <h2>{$titulo}</h2>

      <form class="form-alta" action="verify" method="post">
        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
          </div>
        </div>


        <input type="submit" class="btn btn-primary" value="Login">


      </form>
    </div>
  </div>
  {if $error}
    <div class="row mb-3">
      <h4 class="text-danger">{$error}</h4>
    </div>
  {/if}
</div>

{include file="footer.tpl"}