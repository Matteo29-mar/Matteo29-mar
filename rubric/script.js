// Array di oggetti che rappresentano i risultati della ricerca
const risultati = [
  {
    nome: "Albero",
    immagine: "albero.jpg",
    descrizione: "Un albero è una pianta legnosa che cresce in altezza."
  },
  {
    nome: "Alberi",
    immagine: "albero.jpg",
    descrizione: "Un albero è una pianta legnosa che cresce in altezza."
  },
  {
    nome: "Alberello",
    immagine: "albero.jpg",
    descrizione: "Un albero è una pianta legnosa che cresce in altezza."
  },
  {
    nome: "Banana",
    immagine: "banana.jpg",
    descrizione: "La banana è un frutto tropicale di forma allungata."
  },
  // Aggiungi altri oggetti per i risultati della ricerca
];


function performSearch() {
  const searchInput = document.getElementById("searchInput").value.toLowerCase();
  const cardList = document.getElementById("cardList");
  const risultatiFiltrati = risultati.filter(risultato => risultato.nome.toLowerCase().includes(searchInput));

  displayResults(cardList, risultatiFiltrati);
}

function displayResults(element, results) {
  element.innerHTML = "";

  if (results.length === 0) {
    element.innerHTML = "<p>Nessun risultato trovato.</p>";
  } else {
    results.forEach(result => {
      const card = document.createElement("div");
      card.classList.add("card");
      const image = document.createElement("img");
      image.src = result.immagine;
      const name = document.createElement("h2");
      name.textContent = result.nome;
      const description = document.createElement("p");
      description.textContent = result.descrizione;

      card.appendChild(image);
      card.appendChild(name);
      card.appendChild(description);
      element.appendChild(card);
    });
  }
}
