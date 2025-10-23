## 👨‍💻 Autor

<div align="center">
  <img src="https://avatars.githubusercontent.com/ninomiquelino" width="100" height="100" style="border-radius: 50%">
  <br>
  <strong>Onivaldo Miquelino</strong>
  <br>
  <a href="https://github.com/ninomiquelino">@ninomiquelino</a>
</div>

---

# 📊 CSV Analyzer: PHP Data Parsing with Chart.js Visualization

![Made with PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![Frontend JavaScript](https://img.shields.io/badge/Frontend-JavaScript-F7DF1E?logo=javascript&logoColor=black)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-38B2AC?logo=tailwindcss&logoColor=white)
![License MIT](https://img.shields.io/badge/License-MIT-green)
![Status Stable](https://img.shields.io/badge/Status-Stable-success)
![Version 1.0.0](https://img.shields.io/badge/Version-1.0.0-blue)
![GitHub stars](https://img.shields.io/github/stars/NinoMiquelino/csv-data-php?style=social)
![GitHub forks](https://img.shields.io/github/forks/NinoMiquelino/csv-data-php?style=social)
![GitHub issues](https://img.shields.io/github/issues/NinoMiquelino/csv-data-php)

Este projeto é uma demonstração de como manipular planilhas (CSV) no backend PHP e transformá-las em visualizações de dados dinâmicas no frontend. Ele simula uma aplicação de BI leve, onde o usuário pode carregar um conjunto de dados e criar diferentes tipos de gráficos para análise.

---

## 📊 Recursos Principais

* **Upload e Parsing de Arquivos:** PHP recebe o arquivo CSV e utiliza a função nativa `fgetcsv` para ler os dados linha por linha.
* **Conversão de Tipo:** O PHP tenta converter strings que se parecem com números em floats para facilitar a análise.
* **Retorno Estruturado:** Os dados são retornados ao frontend como um objeto JSON estruturado (cabeçalhos e dados).
* **Visualização Interativa:** O frontend utiliza o **Chart.js** para criar gráficos de Barra, Linha e Pizza dinamicamente.
* **Controles de Coluna:** O usuário pode selecionar qual coluna do CSV deve servir como Rótulo (Eixo X) e qual deve servir como Valor (Eixo Y).

---

## 🛠️ Tecnologias Utilizadas

* **Backend:** PHP 7.4+ (PHP Puro para manipulação de arquivos e strings).
* **Frontend:** HTML5, JavaScript Vanilla e `fetch` API.
* **Visualização:** Chart.js (via CDN).
* **Estilização:** Tailwind CSS (via CDN).

---

## 🧩 Estrutura do Projeto

```
csv-data-php/
├── index.html
├── api.php
├── README.md
├── .gitignore
└── LICENSE
```
---

## ⚙️ Configuração e Instalação

### Pré-requisitos

1.  Um ambiente de servidor web com PHP.
2.  **Permissão de escrita** na pasta de uploads.

### 1. Estrutura e Pasta de Uploads

1.  Crie a estrutura de pastas conforme o diagrama.
2.  **Crie a pasta de uploads:** `mkdir src/uploads`
3.  **Defina as permissões:** Garanta que a pasta `src/uploads` tenha permissão de escrita (ex: `chmod 755 src/uploads/` em Linux/macOS).

### 2. Executar o Servidor

Utilize o servidor embutido do PHP para testes (a partir da raiz do projeto):

```bash
php -S localhost:8001
```

• Acesse: O frontend estará disponível em http://localhost:8001/public/index.html.
​3. Configurar o Endpoint da API
​Confirme que a constante API_URL no arquivo public/index.html aponte corretamente:

```javascript
// public/index.html
const API_URL = 'http://localhost:8001/src/api.php'; 
```

---

## 📝 Instruções de Uso

1. Crie um arquivo de texto e salve-o como dados.csv (ou qualquer nome com extensão .csv).

2. Use o conteúdo de exemplo (ou crie o seu próprio):

```csv
Mês,Receita,Despesa,Margem
Janeiro,50000,20000,30000
Fevereiro,55000,22000,33000
Março,60000,25000,35000
Abril,45000,18000,27000
```

3. Na aplicação, clique em "Selecionar Arquivo CSV" e carregue o arquivo.

4. O PHP processará o arquivo e o frontend será preenchido.

5. Ajuste os Controles:
​• Coluna de Rótulo: Selecione mes (Eixo X).
​• Coluna de Valor: Selecione receita (Eixo Y).
​• Tipo de Gráfico: Escolha entre "Barra", "Linha" ou "Pizza".

6. O gráfico será redesenhado automaticamente com a nova visualização.

---

## 🤝 Contribuições
Contribuições são sempre bem-vindas!  
Sinta-se à vontade para abrir uma [*issue*](https://github.com/NinoMiquelino/csv-data-php/issues) com sugestões ou enviar um [*pull request*](https://github.com/NinoMiquelino/csv-data-php/pulls) com melhorias.

---

## 💬 Contato
📧 [Entre em contato pelo LinkedIn](https://www.linkedin.com/in/onivaldomiquelino/)  
💻 Desenvolvido por **Onivaldo Miquelino**

---
