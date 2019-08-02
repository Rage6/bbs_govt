# Buckeye Boys State

## https://buckeye-boys-state.herokuapp.com

<b>What is Buckeye Boys State (BBS)?</b>
<p>
  This annual summer program is an 8-day, hands-on experience in the operation of a democratic government, the organization of political parties, and the functions within the Ohio government. For more information, <a href="http://www.ohiobuckeyeboysstate.com/">click here</a>.
 </p>

<b>What is this website?</b>
<p>
  This is the hub of multiple "mini-websites" which will help other BBS delegates, friends, and family follow what is happening in the different branches of their government. For example, the BBS Governor and his staff will have an entire page in which they can publicize their most important activities, events, goals, and policies each day.
</p>

<b>Why does BBS need this website?</b>
<p>
  There are three important reasons for this website:
  <ol>
    <li>
      <i>Delegate Learning</i>: Buckeye Boys State is a very large program, often exceeding 1000 delegates, so it is impossible for a single delegate to easily understanding what is happening within their new BBS government as a whole. This website will resolve some of that problem. Its <b>primary reason</b> is to allow delegates to quickly find a particular city, county, or state page and then learn the most up-to-date BBS information that they are searching for.
    </li>
    <li>
      <i>Advertisement/Understanding Among Non-Delegates</i>: The BBS program's only current, consistent means of advertising explaining itself is is by past delegates share their stories/experiences with others. This is not sufficient because, even if all of the delegates were to actively promote BBS, a single delegate cannot thoroughly explain it outside of their role as a delegate. This is why the <b>secondary reason</b> of this website is to display the structure and function of BBS to non-delegates (parents, potential delegates, high school counselors, etc). This explanation can also act as an easy advertisement, with which anyone (delegate or not) can share this website rather than trying to thoroughly explain this seemingly overwhelming program.
    </li>
    <li>
      <i>Government Clarity</i>: As mentioned in the above "primary reason", there will be frequent updates about what has been happening within the numerous government branches of BBS. In this way, this website will serve a <b>third reason</b>, which is to teach the delegates in charge the importance of clear and frequent communication between the elected and their constituents. It is worth noting that these updates will be carried out by THE DELEGATES (and not the counselor staff). The things posted on their webpages (new laws, recent court cases, executive policies, etc) will be written by the delegates themselves. A counselor or Legionnaire will have to approve these posts before they will appears online, but this is mostly to prevent offensive or false posts.
    </li>
  </ol>
</p>

<b>How to use the 'Administrative Center'?</b>
<p>
  The 'Administrative Center' is where a delegate or counselor can add new posts, update current ones, or delete them.
  <ol>
    <li>
      Either click on the 'gear' icon on the home page, or enter the base URL followed by '/admin/login/login.php'
    </li>
    <li>
      Select the desired section that you want to update in the dropdown box
    </li>
    <li>
      Enter either that section's counselor or delegate password.
      <ul>
        <li>
          NOTE: Counselors will have access to the same abilities as a delegate within their section IN ADDITION TO some 'counselor only' options.
        </li>
      </ul>
    </li>
    <li>
      Click 'ENTER'
    </li>
    <li>
      Click on any of the available options to update the desired information.
    </li>
    <li>
      Things worth knowing about
      <ul>
        <li>
          A delegate's post will not be shown online until their section counselor logs in with his password and approves it.
        </li>
        <li>
          As a security measure, user access into <u>a section's session will end after 30 minutes</u> unless the user a) refresh the page, or b) submits an update. To prevent users from submitting changes after a session has expired, a timer (using JavaScript) is displayed at the bottom of the page.
        </li>
        <li>
          In addition to the 30 minute timer, another security tool "locks" a section if it experiences 5 failed login attempts. After that, a) the user's IP address is recorded in the database, and b) the server will not even consider another login attempt.
        </li>
        <li>
          Counselors will have access to the same abilities as a delegate does within their section IN ADDITION TO some 'counselor only' abilities. These include:
          <ol>
            <li>
              <u>Current Staff</u>: List of all of this section's jobs and the names of the delegate that filling those roles
            </li>
            <li>
              <u>Assign A Job</u>: Select a delegate from the overall list of delegates and assign them to one of this section's jobs
            </li>
            <li>
              <u>Delegate Directory</u>: Add a delegate to the overall delegate directory, change a current delegate's name, or delete a delegate from the directory entirely
            </li>
            <li>
              <u>Department Directory</u>: Add, change, or delete a department/agency/etc. within this section. A department's basic information includes: its name, purpose, the title for its delegate-in-charge, and whether it is 'in use' or not.
              <ul>
                <li>
                  A department 'in use' will be displayed online, while one NOT in use won't. This is an option because the number/types of departments often changes from year-to-year.
                </li>
              </ul>
            </li>
          <ol>
        </li>
      </ul>
    </li>
  </ol>
</p>
