<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Busca de repositório de Git</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        hr{
            width: 50vw;
            margin: 10px;
        }
        .m-10{
            margin: 10px;
        }
        li{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color:rgb(74, 151, 196);">
    <div class="container-fluid">
        <h3 class="text-white">Gerenciamento de Tarefas</h3>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link text-white" href="create-usuarios.php">Usuários</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="create-tarefas.php">Tarefas</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="read-gerenciar.php">Gerenciar</a></li>
        </ul>
    </div>
</nav>
    
<h1class="m-10"> Busca de reposilório no GitHub</h1>
    <divclass="m-10">
        <label for="">Nome do Usuário</label>
        <input type="text" id="nome">
        <button onclick="getApi()">Buscar</button>
        <hr>
    </div>

<ul class="m-10">

</ul>

<script>
        function getApi() {
            const ul = document.querySelector('ul')
                ul.innerHTML = ''

            const nome = document.querySelector('#nome').value
            fetch(`https://api.github.com/users/${nome}/repos`)
                .then( async res => {

                    let data = await res.json()

                    data.map(item => {

                        let li = document.createElement('li')
                        li.classList.add('m-10')

                        let hr = document.createElement('li')

                        li.innerHTML = `<strong> ${item.name} </strong>
                        <span>${item.html_url}</span> `

                        ul.appendChild(li)
                        ul.appendChild(hr)

                    })

                })
                .catch(e => {
                    console.log(e);

                    ul.innerHTML = ''
                    let li = document.createElement('li')
                    li.classList.add('m-10')
                    li.innerHTML = `<strong> Erro ao buscar usuário </strong> `

                    ul.appendChild(li)
                })
        }
    </script>


</body>
</html>
