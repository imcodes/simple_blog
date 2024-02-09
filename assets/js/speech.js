//SPEECH METHODS\
const speaker = speechSynthesis;
var utterance = new SpeechSynthesisUtterance('')
var voices = [];
let currentVoiceIndex = 0

function populateVoiceList(target = '#voice-selector'){
    target = document.querySelector(target)
    voices = speaker.getVoices();
    console.log(voices)
    let options = ''
    target.innerHTML = '';
    for(let i = 0; i < voices.length; i++){
        let v = voices[i]
        let isDefault = (v.default) ? '- default' : ''
        options += `<option data-voice-index = ${i} data-name = "${v.name}" data-lang="${v.lang}">${v.name} ${v.lang} ${isDefault}</option>`

    }
    target.innerHTML = options

}

function setVoice(vindex){
    currentVoiceIndex = vindex
}

function readNews(targetDom){
    targetDom = document.querySelector(targetDom)
    const text = targetDom.textContent || targetDom.innerText || '';
    utterance = new SpeechSynthesisUtterance(text)
    changeVoice(currentVoiceIndex)
    speaker.speak(utterance)

}

function changeVoice(){
    utterance.voice = voices[currentVoiceIndex]
}

function pauseRead(){
    if(speaker.speaking){
        speaker.pause()
    } 
}

function resumeRead(){
    if(speaker.paused){
        speaker.resume();
    }
}

function cancelRead(){
    if(speaker.speaking){
        speaker.cancel()
    }
}