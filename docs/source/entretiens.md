

## Entretiens

Une logique de mise en forme spécifique est proposée pour les retranscriptions d’entretiens. Un gabarit spécifique (_interview_) est prévu pour déclarer l’entretien dans les sections du fichier `config.yml` : 

```yml
- title: Entretien
  file: content/text/6.entretien-avec-PI.md
  template: interview
```

Le contenu textuel de l’entretien peut être structuré ainsi dans le fichier markdown :

```pttp
**Votre nom** **Votre question**

**Nom de la personne interview·ée** Sa réponse

**VN** **Votre 2e question (VN sont vos initiales)**

**PI** Sa 2e réponse (PI sont ses initiales)
```
