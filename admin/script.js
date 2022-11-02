
let $selects = document.querySelectorAll('.niveauselec')
$selects.forEach(function ($select) {
  new LinkedSelect($select)
})

class linkedSelect{
    
    constructor ($select){
        this.$select = $select
        this.$target = document.querySelector(this.$select.dataset.target)
        this.onChange = this.onChange.bind(this)
        this.$select.addEventListener('change', this.onChange)

    }

    onChange (e){
        //on recupere les donnees en Ajax
        // this.showloader()
        let request = new XMLHttpRequest()
        request.open('GET', this.$select.dataset.source.replace('$id', e.target.value), true)
        request.onload = () => {
            if (request.status >=200 && request.status <  400){
                let data = JSON.parse(request.responseText)
                let options = data.reduce(function (acc, options) {
                    return acc + '<option value="'+ Option.label + '">' + Option.label +'</option>'
                }, '')
                window.setTimeout(()=>{
                    // this.hideloader()
                    this.$target.innerHTML = options
                    this.$target.insertBeforce(this.$placeholder, this.$target.firstchild)
                    this.$target.selectedIndex = 0
                    this.$target.style.display = null 
                })

            }else {
                alert('Impossible de charger la liste')
            }
        }
        request.onerror = function (){
            alert('Impossible de charger la liste')
        }
        request.send()
    }
    // showloader(){
    //     let loader = document.createTextNode('Chargement...')
    //     this.
    // }
} 
