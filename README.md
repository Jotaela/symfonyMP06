Introducció:
    
- Aquesta és una aplicació MVC i ha estat programada amb les tecnologies Symfony 5 per a la part servidor (API) i vue per a la part client.
A part també hem de tindre en compte que sobre vue corre un framework de css que es diu Vuetify i que s'ha fet servir l'eina vuex per a gestionar la data de l'aplicació

Setting up the project:

    composer install
    npm install
    npm run dev
    
- "Amb composer install instalem les dependencies de php"
- "Amb npm install instalem les dependencies js que ens faran falta a l'hora de complilar la nostra part js del projecte"
- "Amb npm reun dev executarem el processador del webpack per a que ens compile el nostre programa js"

Start server:

    synfony serve
    
Server web url:
    
    - home: http://localhost:8000/
    - animals: http://localhost:8000/animals
    - habitats: http://localhost:8000/habitats
    
Server Api url:
    
    - animals index: http://localhost:8000/api/animals
    - animals show: http://localhost:8000/api/animals/{id}
    - animals update: http://localhost:8000/api/animals/{id}
    - animals push: http://localhost:8000/api/animals
    - animals remove: http://localhost:8000/api/animals/{id}
     
    - habitats index: http://localhost:8000/api/habitats
    - habitats show: http://localhost:8000/api/habitats/{id}
    - habitats update: http://localhost:8000/api/habitats/{id}
    - habitats push: http://localhost:8000/api/habitats
    - habitats remove: http://localhost:8000/api/habitats/{id}