function filterKategori(kategori) {
  const semuaCard = document.querySelectorAll(".card");

  semuaCard.forEach(card => {
    const cardKategori = card.getAttribute("data-kategori");
    if (kategori === "semua" || cardKategori === kategori) {
      card.style.display = "";
    } else {
      card.style.display = "none";
    }
  });
}