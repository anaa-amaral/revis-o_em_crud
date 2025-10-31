<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>

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
