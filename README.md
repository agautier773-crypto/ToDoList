1 ==> installation Docker depuis  : https://www.docker.com/

2 ==> pour Windows choisir la version AMD64

3 ==>  à la fin de l'installation si vous rencontrez un problème avec Docker
       activer la virtualisation depuis le Bios de votre machine

4 ==> Une fois Docker bien installer et que vous l'avez lancer,
      
       --> ouvrrir un terminal git bash choisir l'emplacement ou vous voulez mettre le projet puis lancer la commande :
           git clone git@github.com:agautier773-crypto/ToDoList.git

5 ==> une fois le projet récupérer et se trouve bien sur l'emplacement que vous avez choisi 
      ouvrez le avec un IDE et ajoutez un fichier .env a la racine du projet
    

6 ==> pour mettre en route Docker compose dans le terminal de votre IDE tapez :
       docker compose up --build -d

       et pour l'arrêtez :
       docker compose down -v


7==> pour accéder à l'application : http://localhost:8081/
      pour accéder à la BDD : http://localhost:8082/
