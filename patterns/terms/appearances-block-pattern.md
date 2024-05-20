# <a href="https://webdevstudios.atlassian.net/wiki/spaces/JS/pages/3408822304/Appearances+Block+Pattern" target="_blank">Appearances Block Pattern</a>

<video src="https://api.media.atlassian.com/file/cdba9f3b-006d-49d7-a435-c2eb29d0301f/artifact/video_1280.mp4/binary?client=47041bf2-0393-425f-b0fb-a51245dd80bb&collection=contentId-3408822304&max-age=2592000&token=eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI0NzA0MWJmMi0wMzkzLTQyNWYtYjBmYi1hNTEyNDVkZDgwYmIiLCJhY2Nlc3MiOnsidXJuOmZpbGVzdG9yZTpjb2xsZWN0aW9uOmNvbnRlbnRJZC0zNDA4ODIyMzA0IjpbInJlYWQiXX0sImV4cCI6MTcxNTYyNzQ1NCwibmJmIjoxNzE1NjI0NTc0fQ.SblyxfzUApdoy-CSv4na0Wo_9U3nLO_TY5bfrspbMds" width="auto" height="auto" controls></video>

Description
-----------

The Appearances Pattern presents a full-width WordPress Pattern, offering editors the flexibility to showcase appearances, events, or announcements on any Page or Post. Editors can effortlessly customize the appearance pattern to suit the website's aesthetic and content requirements.

Pattern Components
------------------

The Appearances Pattern comprises the following Core Blocks within a Group Block:

-   **Group Block (class: appearances):** This group block organizes and structures the appearance details. Editors can add multiple core blocks within it to create a cohesive appearance section. This block allows editors to set a captivating background image for the appearance pattern, enhancing visual appeal and engagement.

    -   **Group Block (class: shadow):** Another group block nested within the main group block provides additional organization and flexibility for content placement and styling.

        -   **Row Block (class: appearance) [Repeat as Required]:** The row block facilitates the arrangement of appearance details in a structured format. Editors can duplicate this block to include multiple appearances or events seamlessly.

            -   **Paragraph Block:** This paragraph block, used within the row block, allows editors to input the appearance name.

            -   **Paragraph Block:** This paragraph block is used within the row block and allows editors to input the appearance date.

            -   **Button Block [Open Link in New Tab]:** This block enables editors to add call-to-action buttons associated with each appearance. The button block can direct users to external links or specific pages related to the appearances.

            -   **Separator Block:** The separator block adds visual separation between appearance entries, enhancing readability and visual hierarchy within the pattern.

How to Edit the Appearances Pattern
-----------------------------------

To customize the Appearances Pattern, follow these steps:

### Adding the Appearances Pattern

1.  Navigate to the page or post editor.

2.  Click on the "+" icon to add a new block.

3.  Search for "Appearances" or locate it under the Patterns section.

4.  Click on the pattern to insert it into your page or post.

### Modifying Appearance Details

1.  Click on the background image block to select or upload a suitable image for the Appearances section.

2.  Edit the paragraph blocks within each row block to input relevant appearance details, such as event dates, locations, or descriptions.

3.  Customize the button blocks to include appropriate call-to-action text and URLs, ensuring they open in new tabs if necessary.

### Adding or Removing Appearance Entries

1.  To add additional appearance entries, duplicate the row block containing the appearance details and customize the content accordingly.

2.  To remove appearance entries, delete the respective row blocks as needed.

Troubleshooting
---------------

-   Some components within the pattern have essential classes that must remain intact to preserve the design integrity. Removing these classes may result in layout issues.

-   If a component loses its class, refer to the components outline provided above to identify the correct class. Alternatively, removing and re-adding the pattern can reset it back to the default state with the necessary classes. 