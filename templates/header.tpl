<!DOCTYPE html>
<html lang="en">

<head>
  <base href="{BASE_URL}" />
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet2">
  <title>BI</title>
</head>

<body class="container">

  <h1><span class="d-block p-2 text-bg-dark align-middle d-flex justify-content-center">OUR BUSINESS</span></h1>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home">- HOME -</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="showSales">Sales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="showSeller">Sellers</a>
          </li>
        </ul>


        
       <div class="d-flex">
        {if !isset($smarty.session.user_ID)}
          <div>
            <button class="d-flex btn btn-outline-success" type="submit">
              <a href="login" class="nav-link active">Login</a>
            </button>
          </div>
          {else}
          <div>
         
            <button class="d-flex btn btn-outline-success" type="submit">
              <a href="logout" class="nav-link active">Logout ({$smarty.session.user_email})</a>
            </button>
          </div>
        {/if}
        </div>
      </div>
    </div>
  </nav>