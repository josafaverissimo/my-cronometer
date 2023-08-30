function Cronometer() {
    const cronometerForm = document.getElementById("cronometer-form")
    const timeElement = document.getElementById("time")

    function formatTime(date) {
        const hour = String(date.getHours()).padStart(2, "00")
        const minutes = String(date.getMinutes()).padStart(2, "00")
        const seconds = String(date.getSeconds()).padStart(2, "00")

        return `${hour}:${minutes}:${seconds}`
    }

    function formatDate(date) {
        const day = String(date.getDate()).padStart(2, "00")
        const month = String(date.getMonth() + 1).padStart(2, "00")
        const year = String(date.getFullYear())

        return `${year}-${month}-${day}`
    }

    function formatTimeToSavePHP(date) {        
        const dateFormatted = formatDate(date)
        const timeFormatted = formatTime(date)

        return `${dateFormatted} ${timeFormatted}`
    }

    function timing(date) {
        const oneSecond = 1000;

        setInterval(() => {
            date.setTime(date.getTime() - oneSecond)
            timeElement.textContent = formatTime(date)
        }, oneSecond)
    }

    function startCronometer(time) {
        [hours, minutes, seconds] = time.split(":")
        const timeToDecrement = new Date()

        if(!Cronometer.dateTimeStorage) {
            storeTime(timeToDecrement)
        }

        timeToDecrement.setHours(hours)
        timeToDecrement.setMinutes(minutes)
        timeToDecrement.setSeconds(seconds)

        timing(timeToDecrement)
    }

    function listeningCronometerForm() {
        if(cronometerForm) {
            cronometerForm.addEventListener("submit", event => {
                event.preventDefault()

                const inputValue = cronometerForm.querySelector("input").value

                startCronometer(inputValue)

                cronometerForm.querySelector("button").remove()
            })
        }
    }

    function storeTime(date) {
        const formattedDate = formatTimeToSavePHP(date)
        const target = "https://localhost/cronometer/public/"

        const body = new FormData()
        body.append("start_time", formattedDate)

        fetch(target, {
            method: "POST",
            body
        })
    }

    function startCronometerByDateTimeStorage() {
        const dateTimeStorage = Cronometer.dateTimeStorage

        if(dateTimeStorage) {
            [initialDate, initialTime] = dateTimeStorage.split(" ")
            
            initialDate = initialDate.split("-")
            initialDate[1] = Number(initialDate[1]) - 1

            const initialDateTime = new Date(...initialDate, ...initialTime.split(":"))
            const now = new Date()            
            const difference = now - initialDateTime

            now.setHours(23)
            now.setMinutes(59)
            now.setSeconds(59)
            now.setTime(now.getTime() - difference)

            startCronometer(formatTime(now))
        }
    }

    startCronometerByDateTimeStorage()
    listeningCronometerForm()
}


document.addEventListener("DOMContentLoaded", () => {
    Cronometer()
})