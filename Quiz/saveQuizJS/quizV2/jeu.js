const question = document.querySelector('#question');
const reponses = Array.from(document.querySelectorAll('.reponse-text'));
const progressText = document.querySelector('#progressText');
const scoreText = document.querySelector('#score');
const progressBarFull = document.querySelector('#progressBarFull');

let currentQuestion = {}
let acceptingAnswers = true
let score = 0
let questionCounter = 0
let availableQuestions = []

let questions = 
[
    {
        question: 'Où la Guerre des Clones a-t-elle commencé ?',
        reponse1: 'Géonosis',
        reponse2: 'Tatooine',
        reponse3: 'Naboo',
        reponse4: 'Coruscant',
        bonneReponse: 1,
    },
    {
        question: 'Combien de langages C-3PO parle-t-il ?',
        reponse1: 'Plus de 600',
        reponse2: 'Plus de 6000',
        reponse3: 'Plus de 6 000 000',
        reponse4: 'Plus de 6 000 000 000',
        bonneReponse: 3,
    },
    {
        question: 'Quel est le nom Sith du Comte Dooku ?',
        reponse1: 'Dark Plagueis',
        reponse2: 'Dark Tyranus',
        reponse3: 'Dark Sidious',
        reponse4: 'Dark Bane',
        bonneReponse: 2,
    },
]

const SCORE_POINTS = 10
const MAX_QUESTIONS = 10

function startGame()
{
    questionCounter = 0
    score = 0
    availableQuestions = [...questions]
    getQuestionSuivante()
}

function getQuestionSuivante()
{
    if(availableQuestions.length === 0 || questionCounter > MAX_QUESTIONS)
    {
        localStorage.setItem('mostRecentScore', score)
        return window.location.assign('../Quiz/ecranDeFin.html')
    }
    questionCounter++
    progressText.innerText = `Question ${questionCounter} sur ${MAX_QUESTIONS}`
    progressBarFull.style.width = `${(questionCounter/MAX_QUESTIONS) * 100}%`

    const questionsIndex = Math.floor(Math.random() * availableQuestions.length)
    currentQuestion = availableQuestions[questionsIndex]
    question.innerText = currentQuestion.question

    reponses.forEach(reponse => 
        {
            const number = reponse.dataset['number']
            reponse.innerText = currentQuestion['reponse' + number]
        })

        availableQuestions.splice(questionsIndex, 1)

        acceptingAnswers = true
}

reponses.forEach(reponse =>
    {
        reponse.addEventListener('click', e => 
        {
            if(!acceptingAnswers) return

            acceptingAnswers = false
            const selectedReponse = e.target
            const selectedBonneReponse = selectedReponse.dataset['number']

            let classToApply = selectedBonneReponse == currentQuestion.bonneReponse ? 'correct' : 'false'

            if(classToApply === 'correct')
            {
                incrementScore(SCORE_POINTS)
            }

            selectedReponse.parentElement.classList.add(classToApply)
            setTimeout(() =>
            {
                selectedReponse.parentElement.classList.remove(classToApply)
                getQuestionSuivante()
            }, 1000)
        })
    })

    function incrementScore(num)
    {
        score += num
        scoreText.innerText = score
    }

    startGame()