
<footer>
<style>
        thead {
        background-color: #5DADE2;
    }
	</style>
</footer>
<link href="./css/style.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
<?php 
if(isset($_SESSION['message'])) 
  { 
	  ?>
	  alertify.set('notifier','position', 'top-right');
	  alertify.success('<?= $_SESSION['message'] ?>');
	  <?php 
	  unset($_SESSION['message']);
  }
?>
</script>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>


  <script>
  new DataTable('#example');
  </script>

<script>
  const offenses = {
      Minor: [
          { id: "4.1.1.1", description: "NOT WEARING OF SCHOOL ID CARD" },
          { id: "4.1.1.2", description: "EATING INSIDE THE CLASSROOM, CHEWING BUBBLE GUMS, ETC." },
          { id: "4.1.1.3", description: "LOITERING NEAR THE GATE, STAYING OR SITTING NEAR FIRE ESCAPES, AND THE LIKE" },
          { id: "4.1.1.4", description: "PUBLIC DISPLAY OF AFFECTION" },
          { id: "4.1.1.5", description: "POSTING/ UNAUTHORIZED USED OF BANNERS" },
          { id: "4.1.1.6", description: "SPITTING ON THE FLOOR, CORRIDORS, STAIRWAYS" },
          { id: "4.1.1.7", description: "IMPROPER HAIRCUT, DYEING OF HAIR, WEARING OF EARRINGS" },
          { id: "4.1.1.8", description: "ENTERING THE FACULTY RESTROOM, LOUNGES WITHOUT CONSENT" },
          { id: "4.1.1.9", description: "MALE STUDENT ENTERING THE COMFORT ROOMS FOR FEMALES OR VICE VERSA" },
          { id: "4.1.1.10", description: "UNHYGIENIC AND IMPROPER USE OF COLLEGE FACILITIES" },
          { id: "4.1.1.11", description: "BRINGING IN OF POINTED OBJECTS" },
          { id: "4.1.1.12", description: "REFUSAL TO SUBMIT ONESELF AND BELONGINGS FOR INSPECTION" },
          { id: "4.1.1.13", description: "USING THE DIRTY FINGER SIGN OR VERY LEWD GESTURES" },
          { id: "4.1.1.14", description: "CHARGING OF CELLPHONES, LAPTOPS AND OTHER GADGETS INSIDE CLASSROOMS" }
      ],
      Major: [
          { id: "4.1.2.1", description: "UNAUTHORIZED BRINGING OUT OF SCHOOL FACILITIES" },
          { id: "4.1.2.2", description: "SMOKING WITHIN THE CAMPUS" },
          { id: "4.1.2.3", description: "EXCESSIVE PUBLIC DISPLAY OF AFFECTION" },
          { id: "4.1.2.4", description: "POSSESSION OF PORNOGRAPHIC MATERIALS" },
          { id: "4.1.2.5", description: "VANDALISM OR DESTRUCTION OF SCHOOL PROPERTY" },
          { id: "4.1.2.6", description: "ENTERING SCHOOL PREMISES UNDER THE INFLUENCE OF DRUGS" },
          { id: "4.1.2.7", description: "UNAUTHORIZED OPERATION OF SCHOOL EQUIPMENT" },
          { id: "4.1.2.8", description: "ACTS OF DISRESPECT TO ANY SCHOOL PERSONNEL" },
          { id: "4.1.2.9", description: "ILLEGAL INTRUSION IN CLASSROOM" },
          { id: "4.1.2.10", description: "USE OF SOCIAL MEDIA TO HARASS OR MALICIOUSLY ATTACK ANYONE" }
      ],
      Grave: [
          { id: "4.1.3.1", description: "POSSESSION, USE OR SALE OF PROHIBITED DRUGS" },
          { id: "4.1.3.2", description: "THEFT OR EXTORTION" },
          { id: "4.1.3.3", description: "POSSESSION OF DEADLY WEAPONS" },
          { id: "4.1.3.4", description: "FRAUD OR CHEATING IN EXAMINATIONS" },
          { id: "4.1.3.5", description: "SEXUAL HARASSMENT" },
          { id: "4.1.3.6", description: "ENGAGING IN ANY FORM OF GAMBLING" },
          { id: "4.1.3.7", description: "MALICIOUS AND UNAUTHORIZED DISCLOSURE OF STUDENT RECORDS" },
          { id: "4.1.3.8", description: "ENGAGING IN ACTS OF DISORDERLINESS" },
          { id: "4.1.3.9", description: "UNAUTHORIZED ENTRY INTO RESTRICTED AREAS" },
          { id: "4.1.3.10", description: "COMMITTING ACTS OF TERRORISM" },
          { id: "4.1.3.11", description: "ENGAGING IN PROSTITUTION" },
          { id: "4.1.3.12", description: "COMMITTING ACTS OF VANDALISM" }
      ]
  };

  const sanctions = {
      Minor: [
          "VERBAL OR WRITTEN REPRIMAND",
          "DISCIPLINARY PROBATION"
      ],
      Major: [
          "SUSPENSION(3-50)",
          "PROBATION SUSPENSION(SEMESTER)",
          "SUSPENSION FOR ONE SEMESTER",
          "SUSPENSION FOR ONE SCHOOL YEAR"
      ],
      Grave: [
          "EXCLUSION OR DISMISSAL",
          "EXPULSION"
      ]
  };

  function updateOffenseOptions() {
      const offenseType = document.getElementById('offense_type').value;
      const offenseSelect = document.getElementById('offense_id');
      offenseSelect.innerHTML = ''; 

      if (offenseType) {
          offenses[offenseType].forEach(offense => {
              const option = document.createElement('option');
              option.value = offense.id;
              option.textContent = `${offense.id} - ${offense.description}`;
              offenseSelect.appendChild(option);
          });
          offenseSelect.disabled = false; 
      } else {
          offenseSelect.disabled = true; 
      }
  }

  function updateSanctionOptions() {
      const offenseType = document.getElementById('offense_type').value;
      const sanctionSelect = document.getElementById('sanction');
      sanctionSelect.innerHTML = ''; 

      if (offenseType) {
          sanctions[offenseType].forEach(sanction => {
              const option = document.createElement('option');
              option.textContent = sanction;
              sanctionSelect.appendChild(option);
          });
          sanctionSelect.disabled = false; 
      } else {
          sanctionSelect.disabled = true; 
      }
  }

 
  window.onload = function() {
      const currentOffense = '<?= $data['offense_id'] ?>';
      const currentSanction = '<?= $data['sanction'] ?>';

      if (currentOffense) {
          Array.from(document.getElementById('offense_id').options).forEach(option => {
              if (option.value === currentOffense) {
                  option.selected = true;
              }
          });
      }

      if (currentSanction) {
          Array.from(document.getElementById('sanction').options).forEach(option => {
              if (option.text === currentSanction) {
                  option.selected = true;
              }
          });
      }
  };
</script>
