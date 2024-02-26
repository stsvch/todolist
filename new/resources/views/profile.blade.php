<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>

<div class="flex-shrink-0 p-3" style="width: 280px;">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
        <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-5 fw-semibold"><ya-tr-span data-index="17-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Collapsible" data-translation="Разборный" data-ch="0" data-type="trSpan" style="visibility: initial !important;">Разборный</ya-tr-span></span>
    </a>
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true"><ya-tr-span data-index="18-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Home " data-translation=" Главная " data-ch="1" data-type="trSpan" style="visibility: initial !important;">  Главная  </ya-tr-span></button>
            <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded"><ya-tr-span data-index="19-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Overview" data-translation="Обзор" data-ch="0" data-type="trSpan" style="visibility: initial !important;">Обзор</ya-tr-span></a></li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false"><ya-tr-span data-index="22-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Dashboard " data-translation=" Информационная панель " data-ch="1" data-type="trSpan" style="visibility: initial !important;">  Информационная панель  </ya-tr-span></button>
            <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overview</a></li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="true"><ya-tr-span data-index="23-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Orders " data-translation=" Заказы " data-ch="1" data-type="trSpan" style="visibility: initial !important;">  Заказы  </ya-tr-span></button>
            <div class="collapse show" id="orders-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded"><ya-tr-span data-index="30-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="New" data-translation="Новое" data-ch="0" data-type="trSpan" style="visibility: initial !important;">Новое</ya-tr-span></a></li>
                </ul>
            </div>
        </li>
        <li class="border-top my-3"></li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false"><ya-tr-span data-index="24-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value=" Account " data-translation=" Учетная запись " data-ch="0" data-type="trSpan" style="visibility: initial !important;">  Учетная запись  </ya-tr-span></button>
            <div class="collapse" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">New...</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<h2>User Profile</h2>
<p>Email: {{ $user->email }}</p>
<p>Name: {{ $user->name }}</p>

</body>
</html>
