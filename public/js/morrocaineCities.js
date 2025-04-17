// Fonction pour charger les villes marocaines depuis l'API GeoNames
document.addEventListener("DOMContentLoaded", function () {
    // URL de l'API GeoNames avec vos paramètres
    const apiUrl =
        "http://api.geonames.org/searchJSON?country=MA&username=fatizahra&featureClass=P&maxRows=1000";

    // Sélectionner l'élément select
    const citySelect = document.getElementById("city");

    // Fonction pour trier par ordre alphabétique
    const sortByName = (a, b) => {
        return a.name.localeCompare(b.name);
    };

    // Vider le contenu actuel du select
    citySelect.innerHTML = '<option value="">Sélectionnez une ville</option>';

    // Ajouter un indicateur de chargement visuel (spinner)
    citySelect.disabled = true;
    const loadingContainer = document.createElement("div");
    loadingContainer.id = "loading-cities-container";
    loadingContainer.className = "flex items-center mt-1";
    loadingContainer.innerHTML = `
                <div class="mr-2"><i class="fas fa-spinner fa-spin text-[#580a21]"></i></div>
                <span id="loading-cities" class="text-sm text-gray-500">Chargement des villes...</span>
            `;
    citySelect.parentNode.appendChild(loadingContainer);

    // Récupérer les données de l'API
    fetch(apiUrl)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Erreur réseau: " + response.status);
            }
            return response.json();
        })
        .then((data) => {
            // Récupérer les villes et les trier par ordre alphabétique
            const cities = data.geonames
                .filter((city) => city.fcl === "P")
                .sort(sortByName);

            // Ajouter chaque ville comme option dans le select
            cities.forEach((city) => {
                const option = document.createElement("option");
                option.value = city.name;
                option.textContent = city.name;
                citySelect.appendChild(option);
            });

            // Supprimer l'indicateur de chargement et activer le select
            document.getElementById("loading-cities-container").remove();
            citySelect.disabled = false;
        })
        .catch((error) => {
            console.error("Erreur lors du chargement des villes:", error);

            // En cas d'erreur, afficher un message et réactiver le champ
            document.getElementById("loading-cities").textContent =
                "Erreur lors du chargement des villes. Veuillez saisir manuellement.";
            document.querySelector(
                "#loading-cities-container .fa-spinner"
            ).style.display = "none";
            citySelect.disabled = false;

            // Charger une liste de secours des principales villes
            const fallbackCities = [
                "Casablanca",
                "Rabat",
                "Marrakech",
                "Fès",
                "Tanger",
                "Agadir",
                "Meknès",
                "Oujda",
                "Kénitra",
                "Tétouan",
                "Safi",
                "El Jadida",
            ];

            fallbackCities.forEach((city) => {
                const option = document.createElement("option");
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        });
});
