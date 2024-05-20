# Latest Posts Block Pattern

Description
-----------

The Latest Posts Pattern displays a full-width WordPress Pattern, allowing editors to showcase the latest blog posts or news updates on any Page or Post. It provides flexibility for content editing and additional block inclusion to suit various website needs.

Pattern Components
------------------

The Latest Posts Pattern comprises the following Core Blocks within a Group Block:

-   **Group (class: latest-posts):** Acts as the container for the Latest Posts Pattern, facilitating structural organization and styling.

    -   **Paragraph Block [eyebrow]:** This block functions as a subheading or brief introduction, providing context or emphasis to the Latest Posts section.

    -   **Heading Block:** Presents the primary title or headline of the Latest Posts section, ensuring clarity and prominence.

    -   **Query Loop Block:** Dynamically retrieves and exhibits the latest blog posts based on defined criteria. It comprises several fields:

        -   **Post Template:**

            -   **Featured Image Field:** Utilizes an Image block with a 3:2 aspect ratio to showcase thumbnail images associated with each post.

            -   **Categories:** Displays the categories assigned to each post.

            -   **Title:** Exhibited using a Heading block to highlight the title of each post.

            -   **Excerpt:** Presented within a Paragraph block, offering a concise summary or excerpt of each post.

            -   **Read More:** Linked within a Paragraph block to direct users to the full post or article.

        -   **No results:** Placeholder area where editors can add custom content to display if no posts are available.

    -   **Button Block [link]:** Creates a button linked to the post archive, allowing users to explore additional content related to the Latest Posts section.

How to Edit the Latest Posts Pattern:
-------------------------------------

To customize the Latest Posts Pattern, follow these steps:

### Adding the Latest Posts Pattern:

1.  Navigate to the page or post editor.

2.  Click on the "+" icon to add a new block.

3.  Search for "Latest Posts" or locate it under the Patterns section.

4.  Click on the pattern to insert it into your page or post.

### Modifying Content Blocks:

1.  Click on the Paragraph block to edit the eyebrow text.

2.  Edit the Heading block to update the main title of the Latest Posts section.

3.  Click on the Button block to edit the "more" link.

### Customizing the Query Loop Block:

1.  Click on the Query Loop block to access its settings.

2.  Configure the category field to specify the post category to display.

3.  Adjust the post title, excerpt, featured image, and post URL fields to customize the content displayed for each post.

Troubleshooting
---------------

-   Ensure that the Group block retains the "latest-posts" class to maintain the design consistency of the Latest Posts Pattern.

-   If any component within the pattern loses its class, refer to the components outline provided above to identify the correct class. Alternatively, removing and re-adding the pattern can reset it back to the default state with the necessary classes.