import moment from '../../node_modules/moment/dist/moment.js'
export class News{
    constructor(url,apiKey = null,keyword = ''){
        this.setKeyword(keyword) //set the keyword upon instantiation
        this.setBaseUrl(url)
        this.setApiKey(apiKey)
    }

    //method to set the base url
    setBaseUrl(url){
        this.baseUrl = url
    }
    setApiKey(key){
        this.key=key
    }
    //method to set paramter for the url
    setParams(param){

    }
    // Method to set the keyword prop
    setKeyword(keyword){
        this.keyword = keyword
    }
    getKeyword(){
        return this.keyword
    }

    getUrl(){
        return this.baseUrl
    }
    getApiKey(){
        return this.key
    }

    getNewsList(){
        const urlParam =  (this.getKeyword() != '') ? '&q='+this.getKeyword() : ''
        const url = this.getUrl() + urlParam
        
        const response = fetch(url,{
            method: 'get',
            // crossDomain: true,
            headers: {
                // 'Authorization' : `${this.getApiKey()}`,
                // 'mode': 'cors',
                // 'Access-Control-Allow-Origin' : '*',
                'X-Requested-With': 'XMLHttpRequest',
                // 'Accept' : '*/*'
                
            }
        })
        .then(res => {return res.json()})
        .catch(err => err)
        this.newsList = response
        // this.newsList.then(news => console.log(news))
        console.log(this.newsList)
        return response
        
        
    }

    /**
     * 
     * @param {*} data 
     * @param {'title' || 'id'} by 
     * @returns 
     */
    getNewsDetail(data, by = 'title'){
        const List = this.newsList //get the stroed news list
        return List.then(NewsList => {
            const News = NewsList
            
            const news = News.filter(t => {
                return (by == 'title') ? t.title == data : t.id == data
           })
           return news
        })
    }

    // Method to display the news list
    // this takes an argument of the target DOM
    displayNewsList(target){
        return new Promise(resolve => {
            target.innerHTML = 'loading'
            this.newsList.then(list => {
                const Articles = list
                target.innerHTML = ''
                Articles.map(article => {
                    target.innerHTML += this.showListTemplate(article)
                })
                resolve(target)
                
            })
           
        })
        
    }

    showListTemplate(Article){
        const img = (Article.image) ? Article.image : 'https://placehold.co/600x400'
        return `<div class="col-12 col-sm-6 col-md-3">
        <div class="card border-success" data-title="${Article.title}">
            <div class="card-header p-0">
                <a href="javascript:void(0)">
                    <img src="${img}" class="openModal w-100" alt="">
                </a>
            </div>
            <div class="card-body">
                <h2 class="openModal title h6"><a href="javascript:void(0)" title="${Article.title}">${Article.title.substr(0,40)}</a></h2>
            </div>
            <div class="card-footer">
                <div class="row g-2">
                    <div class="col-12 col-xl-6 author">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>${Article.author ? Article.author.substr(0,30) : 'Nill'}</span>
                    </div>
                    <div class="col-12 col-xl-6 pub-date">
                        <i class="fa fa-calendar-o" aria-hidden="true"></i>
                        <span>${Article.created_at}</span>
                    </div>
                </div>
                
            </div>
        </div>
    </div>`
    }

    showModalTemplate(Detail){
        let {author,image,content,title,source,created_at} = Detail
        image = image ? image : "https://placehold.co/600x400"
        author = author ? author : 'Anonymous'

        created_at = moment(created_at).toNow()

        const section = document.createElement('section')
        section.classList.add('my-modal')
        const output = `
        
        <div class="my-modal-content">
            <div class="modal-display">
                <div class="card" id='news-content'>
                    <div class="card-header p-0 float-title">
                        <img class="title-image border-rounded w-100" src="${image}" alt="${title}">
                        <h2 class="card-title px-5 py-2">${title}</h2>
                    </div>
                    <div class="card-body px-5 py-2">
                        <aside class="meta-data row py-3">
                            <div class="col-12 col-md-3" id="detail-author">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                    <span>By: ${author}</span>
                            </div>
                            <div class="col-12 col-md-3" id="detail-pub-date">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                    <span>Posted on: ${created_at}</span>
                            </div>
                            <div class="col-12 col-md-6" id="speach-control">
                                <div class="input-group mb-3">
                                    <select class="form-control" id="voice-selector" aria-label="" aria-describedby="btn-speak">
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text py-3" id="btn-speak"><i class="fa fa-volume-up"></i></span>
                                    </div>
                                </div>
                            </div>
                            
                        </aside>
                        <div class="py-3" >
                            <p>${content}</p>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
        `
        section.innerHTML=output
        return section
    }

    // Method that receives News Title/Caption as argument 
    //It calls the getNewsDetail() method to fileter list of news by the recived title and return an array of on news object
    //It then calls the showModalTemplate() method to create the template for the modal
    //Finally it appends the Modal template to the document body
    pop(title){
        this.getNewsDetail(title).then(detail => {
            // get template from the showModalTeplate method by passing the filtered data to the method
            const mTemplate = this.showModalTemplate(detail[0]) //this method returns the template as HTML DOM
            const bodyElement = document.querySelector('body') //get the body DOM from the document
            
            //listen for click event on the HTML modal template
            //The goal is to remove the template from the document once user clicks on it.
            mTemplate.onclick = e => {
                //remove the clicked target from the document body
                bodyElement.removeChild(e.target)
                cancelRead()
            }

            //add the Modal template to the document body alongside the event Listner and handler
            bodyElement.appendChild(mTemplate)

            //Grab the speach button
            const btnSpeak = document.querySelector('#btn-speak')
            const voiceSelector = document.querySelector('#voice-selector')
            //listen for change
            voiceSelector.onchange = e => {
               let vIndex =  voiceSelector.selectedOptions[0].getAttribute('data-voice-index')
               const wasReading = speaker.speaking;
                cancelRead()
                setVoice(vIndex)
               if(wasReading) readNews('#news-content')

            }
            populateVoiceList()
            btnSpeak.onclick = e => {
                console.log('should speak')
                readNews('#news-content')
            }
        })
    }

    // Method to handle the Modal open and close when some elements on the webpage are click
    handlePop (tag) {
        tag.querySelectorAll('[data-title]').forEach(card => {
            const title = card.getAttribute('data-title')
            card.querySelectorAll('.openModal').forEach( link => {
                link.onclick = () => {
                    this.pop(title)
                }
                console.log
            })
        })
        
    }

    

}
