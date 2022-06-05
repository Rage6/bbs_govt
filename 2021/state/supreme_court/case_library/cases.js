$(document).ready(()=>{
  // console.log("cases.js is working...");
      const caseLibrary = [
        {
          post_id: 132,
          title: "John Doe v. State",
          content: "The Supreme court had their first case today at 3:00 pm. The case was a mock trial where John Doe was defending from the state. John Doe was charged with an OVI, he waived his right to council and plead guilty. In a case like this it's the plaintiff's duty to have the burden of proof to charge the defendant with the crime. The plaintiff needs to establish audio and written verification for a right to waive an attorney with a guilty plea according to State v. Thompson. The state lacked sufficient evidence so the Supreme court ruled in favor of John Doe 7-0.",
          subtype_id: 7,
        },
        {
          post_id: 941,
          title: "Sid the Kid v. Ohio Buckeye Boys State",
          content: "On June 18th, 2021 the Buckeye Boys State Supreme Court assembled with the Honorable Chief Justice Grayson Segars presiding. The case began with an introduction of the agreeable facts, which were established by the defense and prosecution alongside Magistrate Terrin Jackson before the trial. <br>The facts were as follows...<br>*Sid did not pass the Bar Association Exam<br>*Sid was seen, at some point in time, wearing a Bar Association 'star'<br>*Sid requested Governor Cael Saxton's campaign finance records from the Secretary of State<br>* Sid did, in fact, obtain the financial record<br>After Chief Justice Grayson Segars introduced these facts, Justice Segars delivered the recommended punishment from Magistrate Terrin Jackson. Magistrate Jackson recommended a 3 minute detention while a member of the Bar Association discussed the nobility and honor of the Bar Association as well as why impersonation was such a crime.<br>Chief Justice Segars then opened the floor to the prosecuting attorney who began by stating that while yes, the recommended punishment was fair a more public display was needed so that Sid could properly display his remorse for his actions.<br>The defense then gave their opinions stating that Sid did not testify to actually passing the Bar examination, which makes him innocent. They claimed that on the grounds of the Freedom of Speech, Sid could not be prosecuted because he was only representing himself as a concerned citizen. The defense also stated that the documents Sid was attempting to obtain were public record, and therefore he should not have been kept from them.<br>Chief Justic Segars, in a speedy response, asked the defense why a subpoena was required for Sid if the documents were public record. The defense explained that the Secretary of State withheld the documents, even though, they should have been released.<br>The prosecution closed the arguments by stating that under false pretenses and deception, Sid obtained the files therefore making his actions criminal.<br>The Supreme Court decided they had heard enough of the case and took a brief recess to deliberate and decide on a reasonable outcome for the case.<br>Upon return of the Supreme Justices, Sid's sentence was delivered. The justices believed that punishment was necessary, however, they believed it did, in fact, need to be more sincere and genuine. With that in mind, they required Sid write three apology letters (in purple crayon) to the Secretary of State, Bar Association, and Governor Cael Saxton. They went on to state that Sid was also required to deliver an apology to all parties involved for, as Justice Segars put it, &quot;wasting their time.&quot;<br>Sid seemed to believe that his sentencing was a joke and questioned the consequences of not writing the letters or delivering the apology. The court explained that if Sid did not do this, he would be held in contempt of court until he completed his sentence. This immediately persuaded Sid into apologizing, however, Justice Segars had to coax Sid through the apology so it was actually meaningful.<br>Court was dismissed and the Hetuck interviewed Sid's thoughts on the case.",
          subtype_id: 7
        }
      ];
      const subtypeLibrary = [
        {
          subtype_id: 6,
          subtype_name: "Traffic Related",
          type_id: 6
        },
        {
          subtype_id: 7,
          subtype_name: "Felony",
          type_id: 6
        },
        {
          subtype_id: 8,
          subtype_name: "Misdemeanor",
          type_id: 6
        },
        {
          subtype_id: 9,
          subtype_name: "Genera",
          type_id: 6
        },
        {
          subtype_id: 10,
          subtype_name: "Voter Fraud",
          type_id: 6
        }
      ];
      // console.log(caseLibrary);
      // Lists all of the subtypes as buttons
      for (let subtypeNum = 0; subtypeNum < subtypeLibrary.length; subtypeNum++) {
        $("#subtypeBttnList").append("<div class='subtypeBttn' data-selectid='"+subtypeLibrary[subtypeNum]['subtype_id']+"'>"+subtypeLibrary[subtypeNum]['subtype_name']+"</div>");
      };

      // Shows/hides the subtype list
      $("#selectBox").click(()=>{
        if ($(".subtypeBttnList").css('display') == "block") {
          $(".subtypeBttnList").css('display','none');
        } else {
          $(".subtypeBttnList").css('display','block');
        };
      });

      // Selects a subtype, changes the data-subtypeid, shows its name, and hides the list
      $("[data-selectid]").click((event)=>{
        $("#caseBttnList").empty();
        for (let searchNum = 0; searchNum < subtypeLibrary.length; searchNum++) {
          if (event.target.dataset.selectid == subtypeLibrary[searchNum]['subtype_id']) {
            $("#selectBox").attr("data-subtypeid",event.target.dataset.selectid);
            let selectName = subtypeLibrary[searchNum]['subtype_name'];
            $("#selectBox").text(selectName);
            if (window.outerWidth < 769) {
              $(".subtypeBttnList").css('display','none');
            } else {
              $(".subtypeBttn").css('color','white');
              $("[data-selectid=" + event.target.dataset.selectid + "]").css('color','#fec231');
            };
            addSelectedCases(subtypeLibrary[searchNum]['subtype_id']);
            break;
          };
        };
      });

      // Draws up the names and IDs of the selected subtype's cases
      const addSelectedCases = (thisSubtype) => {
        let hasCase = false;
        $("#caseContent").empty();
        $("#caseContent").append("<i>-- No case selected --</i>");
        for (let caseNum = 0; caseNum < caseLibrary.length; caseNum++) {
          if (caseLibrary[caseNum]['subtype_id'] == thisSubtype) {
            if ($(".caseBttnList").css('display') == 'none') {
              $(".caseBttnList").css('display','block');
            };
            $("#caseBttnList").append("<div class='caseBttn' data-caseid='" + caseLibrary[caseNum]['post_id'] + "'>" + caseLibrary[caseNum]['title'] + "</div>");
            hasCase = true;
          };
        };
        if (hasCase == false) {
          $("#caseBttnList").append("<i>-- No case found --</i>");
        };
        // Colors the selected button and inserts the content on
        $("[data-caseid]").click((event)=>{
          $(".caseBttn").css('color','white');
          let caseId = event.target.dataset.caseid;
          $("[data-caseid="+caseId+"]").css('color','#fec231')
          let hasText = false;
          $("#caseContent").empty();
          for (let contNum = 0; contNum < caseLibrary.length; contNum++) {
            if (event.target.dataset.caseid == caseLibrary[contNum]['post_id']) {
              $("#caseContent").empty();
              $("#caseContent").append("<div style='text-align:center'><i>" + caseLibrary[contNum]['title'] + "</i></div></br><div>" + caseLibrary[contNum]['content'] + "</div>");
              hasText = true;
              break;
            };
          };
          if (hasText == false) {
            $("#caseContent").append("<i>Select a case above</i>");
          };
        });
      };
});
