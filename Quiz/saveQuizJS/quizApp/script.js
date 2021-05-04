const startButton = document.getElementById('start-btn')
const nextButton = document.getElementById('next-btn')
const questionContainerElement = document.getElementById('question-container')
const questionElement = document.getElementById('question')
const answerButtonsElement = document.getElementById('answer-buttons')

let questionsAleatoire, currentQuestion

startButton.addEventListener('click', commencerJeu)
nextButton.addEventListener('click', () => 
{ 
    currentQuestion++
    setQuestionSuivante()
})

function commencerJeu()
{
    console.log('Started')
    startButton.classList.add('hide')
    questionsAleatoire = questions.sort(() => Math.random() - .5)
    currentQuestion = 0
    questionContainerElement.classList.remove('hide')
    setQuestionSuivante()
}

function setQuestionSuivante()
{
    resetState()
    afficherQuestion(questionsAleatoire[currentQuestion])
}

function afficherQuestion(question)
{
    questionElement.innerText = question.question
    question.reponses.forEach(reponse => 
        {
            const button = document.createElement('button')
            button.innerText = reponse.text
            button.classList.add('btn')
            if(reponse.correct)
            {
                button.dataset.correct = reponse.correct
            }
            button.addEventListener('click', selectReponse)
            answerButtonsElement.appendChild(button)
        })
}

function resetState()
{
    clearStatusClass(document.body)
    nextButton.classList.add('hide')
    while(answerButtonsElement.firstChild)
    {
        answerButtonsElement.removeChild(answerButtonsElement.firstChild)
    }
}

function selectReponse(r)
{
    const selectecButton = r.target
    const correct = selectecButton.dataset.correct
    setStatusClass(document.body, correct)
    Array.from(answerButtonsElement.children).forEach(button =>
        {
            setStatusClass(button, button.dataset.correct)
        })
        if(questionsAleatoire.length > currentQuestion + 1)
        {
            nextButton.classList.remove('hide')
        } else {
            startButton.innerText = 'Restart'
            startButton.classList.remove('hide')
        }
        
}

function setStatusClass(element, correct)
{
    clearStatusClass(element)
    if(correct)
    {
        element.classList.add('correct')
    } else {
        element.classList.add('wrong')
    }
}

function clearStatusClass(element)
{
    element.classList.remove('correct')
    element.classList.remove('wrong')
}

const questions = 
[
    {
        question: 'Où la Guerre des Clones a-t-elle commencé ?',
        reponses: 
        [
            { text: 'Géonosis', correct: true },
            { text: 'Tatooine', correct: false },
            { text: 'Naboo', correct: false },
            { text: 'Coruscant', correct: false }
        ]
    },
    {
        question: 'Quelle est la vision prophétique révélée à Luke dans la grotte sur Dagobah pendant son entraînement avec Yoda ?',
        reponses: 
        [
            { text: 'La mort de Yoda', correct: false },
            { text: 'Son propre visage sous le masque de Dark Vador', correct: true },
            { text: 'Han Solo congelé dans un bloc de carbonite', correct: false },
            { text: 'Leia prisonnière de Jabba le Hutt', correct: false }
        ]
    },
    {
        question: 'Combien de langages C-3PO parle-t-il ?',
        reponses: 
        [
            { text: 'Plus de 600', correct: false},
            { text: 'Plus de 6000', correct: false },
            { text: 'Plus de 6 000 000', correct: true },
            { text: 'Plus de 6 000 000 000', correct: false }
        ]
    },
    {
        question: 'Quel est le nom Sith du Comte Dooku ?',
        reponses: 
        [
            { text: 'Dark Tyranus', correct: true },
            { text: 'Dark Plagueis', correct: false },
            { text: 'Dark Sidious', correct: false },
            { text: 'Dark Bane', correct: false }
        ]
    },
]