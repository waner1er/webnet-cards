### On souhaite développer un jeu de cartes.

Dans ce jeu, un joueur tire une main de X cartes de manière aléatoire depuis un jeu composé
de 52 cartes uniques.
Chaque carte possède une couleur ("Carreau", par exemple) et une valeur ("10", par
exemple). La « force » d’une carte est basée sur sa couleur puis sur sa valeur selon un ordre
convenu d’avance.

### On vous demande de :

- Construire un ordre aléatoire des couleurs.
  L'ordre des couleurs est, par exemple, l'un des suivants : Carreau, Cœur, Pique, Trèfle
- Construire un ordre aléatoire des valeurs.
  L'ordre des valeurs est, par exemple, l'un des suivants : AS, 5, 10, 8, 6, 5, 7, 4, 2, 3, 9,
  Dame, Roi, Valet
- Permettre à l’utilisateur de saisir le nombre (X) de cartes à piocher et à la validation
  construire une main de X cartes de manière aléatoire.
- Présenter la main "non triée" à l'écran puis la main triée selon n'importe l’ordre défini
  aléatoirement dans la 1ère et 2ème étape.
  C'est-à-dire que vous devez classer les cartes par couleur puis valeur.

---

### Architecture du projet

<b>Entities</b>

- <b>Game</b> Partie en cours
- <b>Player</b> (mise en iceblocks en début de test car facultatif et bonus) Joueur

<b>Classes métiers</b>

- <b>Card</b> : Représente une carte (couleur + valeur)
- <b>Deck</b> : Paquet de 52 cartes, tirage aléatoire
- <b>Hand</b> : Main d’un joueur
- <b>Sorter</b> : Trie une main selon un ordre de couleurs et de valeurs
  Enum Suit (couleurs) et CardValue (valeurs)
