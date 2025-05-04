

const containerCalendar = document.getElementById("container_calendar");
const content_reservation = document.getElementById("calender");
const containerCreateReservation = document.getElementById(
    "containerCreateReservation"
);
const containerAllReservation = document.getElementById(
    "container_all_reservation"
);

const content_reservations = document.getElementById("content_reservations");
const addNewReservationButton = document.getElementById(
    "addNewReservationButton"
);
const timeFrom = document.getElementById("time-from");
const timeTo = document.getElementById("time-to");
let allReservations;
let dateReservation;
let terrain_id;
let squad_id;
function showcontainerCalendar(terrainId, squadId) {
    document.querySelector("#calendar").classList.remove("hidden");
    containerCalendar.classList.remove("hidden");
    containerCalendar.classList.add("flex");
    $(document).ready(function () {
        $("#calendar").fullCalendar({
            header: {
                left: "prev,next,today",
                center: "title",
                right: "month",
            },

            // Add this dayClick handler with past day check
            dayClick: function (date, jsEvent, view) {
                // Vérifier si la date est dans le passé
                const today = moment().startOf("day");
                if (date.isBefore(today)) {
                    // Si la date est dans le passé, ne rien faire
                    return;
                }

                // Sinon, procéder normalement
                getAllReservations(date.format(), terrainId, squadId);
            },

            // Add hover functionality
            eventRender: function (event, element) {
                element.css("cursor", "pointer");
            },

            // Add hover effect on days and apply past day style
            viewRender: function (view, element) {
                // Récupérer la date d'aujourd'hui
                const today = moment().startOf("day");

                // Appliquer les styles à tous les jours
                $(".fc-day").each(function () {
                    const cellDate = moment($(this).data("date"));

                    // Si la date est dans le passé
                    if (cellDate.isBefore(today)) {
                        $(this).addClass(
                            "bg-gray-200 opacity-50 cursor-not-allowed"
                        );
                    } else {
                        // Pour les jours futurs, ajouter l'effet de survol
                        $(this).hover(
                            function () {
                                // Mouse enter (seulement pour les jours futurs)
                                $(this).css(
                                    "background-color",
                                    "rgba(88, 10, 33, 0.8)"
                                );
                            },
                            function () {
                                // Mouse leave
                                $(this).css("background-color", "");
                            }
                        );
                    }
                });

                // Désactiver visuellement les numéros de jour dans le passé
                $(".fc-day-number").each(function () {
                    const cellDate = moment(
                        $(this).closest(".fc-day").data("date")
                    );
                    if (cellDate.isBefore(today)) {
                        $(this).addClass("text-gray-400");
                    }
                });
            },

            // Empêcher la navigation vers les mois passés
            viewDateConstraint: {
                start: moment().startOf("month").format("YYYY-MM-DD"),
            },
        });
    });
}

function getAllReservations(date, terrainId, squadId) {
    fetch(`/joueur/reservations/${date}/${terrainId}/${squadId}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
    })
        .then((response) => {
            if (!response.ok) throw new Error("Erreur réseau");
            return response.json();
        })
        .then((data) => {
            showAllReservations(data, date, terrainId, squadId);
        })
        .catch((error) => console.error("Erreur :", error));
}

function showAllReservations(reservations, date, terrainId, squadId) {
    allReservations=reservations;
        containerAllReservation.classList.remove("hidden");
    containerAllReservation.classList.add("flex");

    // Clear previous content
    content_reservations.innerHTML = "";

    // Create a heading
    const heading = document.createElement("h2");
    heading.textContent = "Réservations disponibles";
    heading.className = "text-xl font-bold mb-4 text-center";
    content_reservations.appendChild(heading);

    // Check if there are any reservations
    if (reservations.length === 0) {
        const noReservations = document.createElement("p");
        noReservations.textContent =
            "Aucune réservation disponible pour cette date.";
        noReservations.className = "text-center text-gray-600";
        content_reservations.appendChild(noReservations);
       addNewReservationButton.addEventListener("click", function () {
           addReservation(reservations, date, terrainId, squadId);
       });
        return;
    }

    // Create a container for the reservation list
    const reservationList = document.createElement("div");
    reservationList.className = "grid gap-3";

    // Loop through each reservation and create a card
    reservations.forEach((reservation) => {
        const card = document.createElement("div");
        card.className =
            "bg-white/20 p-4  rounded-lg shadow-md border border-gray-200";

        // Create card content
        card.innerHTML = `
            <div class="flex justify-between items-center">
                
                    
                    <p class="text-sm ">Terrain: ${reservation.terrain.name}</p>
                   <p class="text-sm ">Reservation Type: ${reservation.reservationType}</p>
                           

                    <h3 class="font-semibold">date debut ${reservation.heure_debut}</h3>
                     <h3 class="font-semibold">date debut ${reservation.heure_fin}</h3> 
               
               
            </div>
        `;

        reservationList.appendChild(card);
       
    });
     addNewReservationButton.addEventListener("click", function () {
         addReservation(reservations, date, terrainId, squadId);
     });

    // Add the list to the container
    content_reservations.appendChild(reservationList);
    content_reservations.classList.remove("hidden");
}

function addReservation(reservation,date, terrainId, squadId) {
    containerCreateReservation.classList.remove('hidden');
    containerCreateReservation.classList.add("flex");
   dateReservation = date;
   terrain_id=terrainId;
   squad_id=squadId;
    
    
}


function changetime() {
    const startTime = timeFrom.value;
    const endTime = timeTo.value;
    
    // Supprimer l'ancien message d'erreur s'il existe
    const errorMessage = document.getElementById('time-error-message');
    if (errorMessage) errorMessage.remove();
    
    // Désactiver le bouton par défaut
    const button = document.getElementById('reserveButton');
    if (button) {
        button.disabled = true;
        button.classList.add('opacity-50', 'cursor-not-allowed');
    }
    
    // Vérifier seulement si les deux champs sont remplis
    if (startTime && endTime) {
        // Convertir en minutes
        const [startHours, startMinutes] = startTime.split(':').map(Number);
        const [endHours, endMinutes] = endTime.split(':').map(Number);
        const startMinutesTotal = startHours * 60 + startMinutes;
        const endMinutesTotal = endHours * 60 + endMinutes;
        
        // Vérification 1: Heure de fin après heure de début
        if (startMinutesTotal >= endMinutesTotal) {
            showError("L'heure de fin doit être après l'heure de début");
            return;
        }
        
        // Vérification 2: Plages interdites (13h30-14h30 et 00h00-08h00)
        // Plage 13h30-14h30
        const debutInterdit1 = 13 * 60 + 30;
        const finInterdit1 = 14 * 60 + 30;
        
        // Plage 00h00-08h00
        const debutInterdit2 = 0;
        const finInterdit2 = 8 * 60;
        
         if (
             startMinutesTotal < finInterdit2 &&
             endMinutesTotal > debutInterdit2
         ) {
             showError(
                 "Les réservations entre minuit et 8h00 ne sont pas disponibles"
             );
             return;
         }
        if (startMinutesTotal < finInterdit1 && endMinutesTotal > debutInterdit1) {
            showError("Les réservations entre 13h30 et 14h30 ne sont pas disponibles");
            return;
        }
        
       
        
        // Vérification 3: Chevauchement avec réservations existantes
        if (allReservations && allReservations.length > 0) {
            for (const reservation of allReservations) {
                const [resDebutH, resDebutM] = reservation.heure_debut.split(':').map(Number);
                const [resFinH, resFinM] = reservation.heure_fin.split(':').map(Number);
                
                const resDebut = resDebutH * 60 + resDebutM;
                const resFin = resFinH * 60 + resFinM;
                
                if (startMinutesTotal < resFin && endMinutesTotal > resDebut) {
                    showError(`Plage horaire déjà réservée (${reservation.heure_debut}-${reservation.heure_fin})`);
                    return;
                }
            }
        }
        
        // Si toutes les vérifications sont passées, activer le bouton
        if (button) {
            button.disabled = false;
            button.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }
}

function showError(message) {
    // Créer message d'erreur
    const errorDiv = document.createElement('div');
    errorDiv.id = 'time-error-message';
    errorDiv.className = 'text-red-500 text-sm mt-2 w-full text-center';
    errorDiv.textContent = message;
    
    // Placer après les inputs
    const inputContainer = document.querySelector('#contentCreateReservation .flex.flex-wrap');
    inputContainer.parentNode.insertBefore(errorDiv, inputContainer.nextSibling);
    
    // Désactiver le bouton
    const button = document.getElementById('reserveButton');
    if (button) {
        button.disabled = true;
        button.classList.add('opacity-50', 'cursor-not-allowed');
    }
}

function submitReservation() {
    const startTime = timeFrom.value;
    const endTime = timeTo.value;

    if (!startTime || !endTime) {
        showError("Veuillez sélectionner les horaires de début et de fin");
        return;
    }

    // Utilisation des variables globales renommées
    if (!dateReservation || !terrain_id || !squad_id) {
        showError("Informations de réservation incomplètes");
        return;
    }

    // Préparer les données pour l'API
    const formData = new URLSearchParams();
    formData.append("date", dateReservation);
    formData.append("terrain_id", terrain_id);
    formData.append("squad_id", squad_id);
    formData.append("heure_debut", startTime);
    formData.append("heure_fin", endTime);
    formData.append(
        "_token",
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
    );

    // Afficher un indicateur de chargement
    const button = document.getElementById("reserveButton");
    const originalText = button.textContent;
    button.disabled = true;
    button.textContent = "Réservation en cours...";

    // Envoyer la requête à notre contrôleur
    fetch("/joueur/reservations/add", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                // Afficher un message de succès
                const successDiv = document.createElement("div");
                successDiv.className =
                    "bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 rounded shadow-md w-full";
                successDiv.innerHTML = `
                <div class="flex items-center">
                    <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>${
                        data.message || "Réservation créée avec succès!"
                    }</span>
                </div>
            `;

                // Supprimer tout message d'erreur existant
                const errorMessage =
                    document.getElementById("time-error-message");
                if (errorMessage) errorMessage.remove();

                // Ajouter le message de succès
                const container = document.querySelector(
                    "#contentCreateReservation"
                );
                const inputs = document.querySelector(
                    "#contentCreateReservation .flex.flex-wrap"
                );
                if (inputs) {
                    inputs.parentNode.insertBefore(
                        successDiv,
                        inputs.nextSibling
                    );
                } else if (container) {
                    container.appendChild(successDiv);
                }

                // Fermer la popup après 2 secondes et rafraîchir la page
                setTimeout(() => {
                    closeContainerCreateReservation();
                    window.location.reload();
                }, 2000);
            } else {
                // Afficher le message d'erreur
                showError(
                    data.message ||
                        "Erreur lors de la création de la réservation"
                );
            }
        })
        .catch((error) => {
            console.error("Erreur:", error);
            showError("Une erreur s'est produite lors de la réservation");
        })
        .finally(() => {
            // Restaurer le bouton
            button.textContent = originalText;
            button.disabled = false;
        });
}


function closeContainerCalendar() {
    containerCalendar.classList.add("hidden");
    containerCalendar.classList.remove("flex");
}

function closeContainerCreateReservation() {
    containerCreateReservation.classList.add("hidden");
    containerCreateReservation.classList.remove("flex");
}

function closeContainerAllReservation() {
    containerAllReservation.classList.remove("flex");
    containerAllReservation.classList.add("hidden");
}
