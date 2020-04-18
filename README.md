Introducció:
    
- Aquesta és una aplicació MVC i ha estat programada amb les tecnologies Symfony 5 per a la part servidor (API) i vue per a la part client.
A part també hem de tindre en compte que sobre vue corre un framework de css que es diu Vuetify i que s'ha fet servir l'eina vuex per a gestionar la data de l'aplicació

Requeriments:

- php 7.2.x
- npm
- composer
- symfony

Setting up the project:

    composer install
    npm install
    npm run dev
    
- "Amb composer install instalem les dependencies de php"
- "Amb npm install instalem les dependencies js que ens faran falta a l'hora de complilar la nostra part js del projecte"
- "Amb npm reun dev executarem el processador del webpack per a que ens compile el nostre programa js"
- També fara falta configurar el .env. En la linea 28 es on podrem modificar la connexió a la base de dades. A part de configurar la connexió també s'ha de crear la base de dadaes, la que hi ha per defecte es diu symfonyDB 

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
    
Bugs i problemes

- hi ha un petit problema a l'hora decarregar el estat en la plantilla de habitats, ja que el vuex no reconeix la mutació SET_HABITATS_STATE, ho soluciona fent una petició axios a la api durant la creació del component habitats-list.
- les funcions que retornen els objectes els retorna en bucle, ja que quan crides habitat te una propietat animals i aixi mateix animals te habitas etc. Aquesta problematica fa que es generen jsons molt més grans del que toca. He fet MOOLTA recercas i fet MOOLTES proves pero ninguna funciona bé. Aquest problema provoca que es llançe la excepció CircularReferenceException i la controlo al serlialyzer del json, però sol meviat el pantallazo d'error. També he fet probes amb grups, pax depth i altres però sense éxit.