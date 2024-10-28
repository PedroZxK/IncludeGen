<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saúde e Bem-Estar</title>
  <link rel="stylesheet" href="assets\css\saude.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<div id="content">
        <nav id="navbar">
            <div class="navbar-includeGen">
                <div class="left-nav-div">
                    <img src="assets/img/logo.png" alt="Logo">
                </div>
                <div class="itens-nav-div">
                    <ul>
                        <li><a href="#">Página inicial</a></li>
                        <li><a href="#">Saúde</a></li>
                        <li><a href="#">Entretenimento</a></li>
                        <li><a href="#">Fórum</a></li>
                        <li><a href="#">Previdência</a></li>
                    </ul>
                </div>
                <div class="right-nav-div">
                    <img src="assets/img/avatar_temp.webp" alt="Avatar">
                    <p style="color: white;"><?= htmlspecialchars($username); ?></p>
                </div>
            </div>
        </nav>



  <section class="hero">
    <img src="assets/img/sorrindo-idosos.png" alt="Idosos sorrindo">
  </section>


  <section class="profissionais">
    <h2>Encontre profissionais para te ajudar</h2>
    <div class="cards-container">
      <div class="card">
        <img src="assets/img/mulher.png" alt="Ana Laura">
        <h3>Ana Laura</h3>
        <p>Me chamo Ana Laura tenho 35 anos e possuo 10 anos de experiência com cuidados com idosos.</p>
        <button>Saiba mais</button>
      </div>
      <div class="card">
        <img src="assets/img/mulher.png" alt="Ana Laura">
        <h3>Ana Laura</h3>
        <p>Me chamo Ana Laura tenho 35 anos e possuo 10 anos de experiência com cuidados com idosos.</p>
        <button>Saiba mais</button>
      </div>
      <div class="card">
        <img src="assets/img/mulher.png" alt="Ana Laura">
        <h3>Ana Laura</h3>
        <p>Me chamo Ana Laura tenho 35 anos e possuo 10 anos de experiência com cuidados com idosos.</p>
        <button>Saiba mais</button>
      </div>
    </div>
  </section>


  <section class="saude">
    <h2>Saúde nunca é demais</h2>
    <div class="cards-container">
      <div class="card">
        <img src="assets/img/alzheimer.png" alt="Alzheimer">
        <h3>Alzheimer: Saiba tudo sobre ela</h3>
        <p>O que é o Alzheimer, causas, prevenção e tratamento.</p>
        <button>Saiba mais</button>
      </div>
      <div class="card">
        <img src="assets/img/alzheimer.png" alt="Alzheimer">
        <h3>Alzheimer: Saiba tudo sobre ela</h3>
        <p>O que é o Alzheimer, causas, prevenção e tratamento.</p>
        <button>Saiba mais</button>
      </div>
      <div class="card">
        <img src="assets/img/alzheimer.png" alt="Alzheimer">
        <h3>Alzheimer: Saiba tudo sobre ela</h3>
        <p>O que é o Alzheimer, causas, prevenção e tratamento.</p>
        <button>Saiba mais</button>
      </div>
    </div>
  </section>

  <div id="footer-div">
            <footer class="includeGen-footer">
                <div class="left-footer">
                    <img src="assets/img/logo.png" class="img-footer-logo" alt="Logo Include Gen" width="50vh">
                    <p>Unindo gerações através da inclusão</p>
                </div>

                <div class="right-footer">
                    <div class="contact-links">
                        <a href="https://instagram.com"><img src="assets/img/instagram.png" id="instagram-contact" alt="Instagram IncludeGen" width="50vh"></a>
                        <a href="https://facebook.com"><img src="assets/img/facebook.webp" id="facebook-contact" alt="Facebook IncludeGen" width="50vh"></a>
                        <a href="https://twitter.com"><img src="assets/img/twitter.png" id="twitter-contact" alt="Twitter IncludeGen" width="50vh"></a>
                        <p>© 2024 IncludeGen. Todos os direitos reservados.</p>
                    </div>
                </div>
            </footer>
        </div>

    </div>

</body>
</html>
