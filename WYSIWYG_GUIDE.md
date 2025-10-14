# WYSIWYG Editor Guide - Tiptap Editor

## 🎨 World-Class Rich Text Editor

Your Filament admin panel now includes **FilamentTiptapEditor** - a modern, powerful WYSIWYG editor with all the features you need to create beautiful content.

## ✨ Features Included

### Text Formatting
- **Bold**, *Italic*, ~~Strikethrough~~, <u>Underline</u>
- Superscript & Subscript
- Lead text (larger intro text)
- Small text
- Text colors & highlighting

### Headings & Structure
- H1, H2, H3, H4, H5, H6
- Paragraphs
- Horizontal rules (dividers)
- Blockquotes

### Lists
- Bullet lists
- Numbered lists
- Checklist/Task lists

### Media
- **Image uploads** (drag & drop or browse)
- Image alignment (left, center, right)
- Image captions
- Video embeds (YouTube, Vimeo, etc.)
- oEmbed support (paste any URL)

### Advanced Features
- **Tables** - Create and edit tables with rows/columns
- **Grid layouts** - Multi-column content
- **Details/Accordion** - Collapsible content sections
- **Code blocks** - Syntax highlighted code
- **Inline code** - `code snippets`
- **Links** - Add hyperlinks with custom text

### Alignment
- Align left
- Align center
- Align right

### Content Blocks
- Pre-built content blocks
- Typography presets
- Source code view (HTML)

## 📝 How to Use

### Creating Blog Posts

1. **Login to Admin Panel**
   - Go to http://localhost:8000/admin
   - Navigate to "Blog Posts"
   - Click "New Blog Post"

2. **Fill in Basic Info**
   - **Title**: Your post title (slug auto-generates)
   - **Subtitle**: Optional subtitle
   - **Excerpt**: Short summary (150-200 chars)

3. **Use the WYSIWYG Editor**
   - Click in the "Content" field
   - Use the toolbar at the top for formatting
   - Type naturally - it works like Microsoft Word

4. **Add Images**
   - Click the image icon in toolbar
   - Drag & drop or browse files
   - Images are automatically uploaded to `/storage/blog-images/`
   - Supports: JPEG, PNG, WebP, SVG
   - Max size: 5MB

5. **Add Featured Image**
   - Scroll to "Media" section
   - Upload your featured image
   - Use the image editor to crop/adjust
   - Choose aspect ratio: 16:9, 4:3, or 1:1

6. **Publishing**
   - Toggle "Published" to make it live
   - Set "Publish Date" (defaults to now)
   - Click "Create" to save

7. **SEO (Optional)**
   - Expand "SEO" section
   - Add Meta Title (50-60 chars)
   - Add Meta Description (150-160 chars)

### Creating Pages

Same process as blog posts, but for static pages:
- About page: slug = `about`
- Research Interests: slug = `research-interests`

## 🎯 Pro Tips

### Image Best Practices
- **Featured images**: 1200x630px (16:9) for best results
- **In-content images**: Max 1200px wide
- Use WebP format for smaller file sizes
- Add alt text for accessibility

### Writing Tips
- Use **H2** for main sections
- Use **H3** for subsections
- Keep paragraphs short (2-3 sentences)
- Use bullet lists for easy scanning
- Add blockquotes for emphasis
- Use lead text for intro paragraphs

### Tables
- Click table icon → Insert table
- Right-click cells for options
- Add/remove rows and columns
- Merge cells if needed

### Code Blocks
- Click code block icon
- Select language for syntax highlighting
- Supports: PHP, JavaScript, Python, etc.

### Embeds
- Paste YouTube/Vimeo URL
- Click oEmbed icon
- Supports Twitter, Instagram, etc.

## 🖼️ Image Management

### Where Images Are Stored
- **Blog images**: `/storage/app/public/blog-images/`
- **Featured images**: `/storage/app/public/featured-images/`
- **Page images**: `/storage/app/public/page-images/`

### Accessing Images
Images are accessible at:
```
https://yourdomain.com/storage/blog-images/filename.jpg
```

### Image Editor Features
- Crop to aspect ratio
- Rotate
- Flip
- Adjust brightness/contrast
- Preview before saving

## 🎨 Styling Content

The editor outputs clean HTML that's automatically styled on your website with:
- Beautiful typography
- Responsive images
- Styled links (rose color)
- Code syntax highlighting
- Responsive tables
- Mobile-friendly layout

## 🔧 Technical Details

### Editor Configuration
- **Output format**: HTML
- **Max file size**: 5MB (5120KB)
- **Allowed image types**: JPEG, PNG, WebP, SVG
- **Storage disk**: Public (accessible via web)

### Customization
To modify editor settings, edit:
```php
/app/Filament/Resources/BlogPostResource.php
/app/Filament/Resources/PageResource.php
```

## 🆘 Troubleshooting

### Images Not Uploading
1. Check storage link exists:
   ```bash
   php artisan storage:link
   ```
2. Check folder permissions:
   ```bash
   chmod -R 755 storage
   ```

### Editor Not Loading
1. Clear cache:
   ```bash
   php artisan cache:clear
   ```
2. Rebuild assets:
   ```bash
   npm run build
   ```

### Content Not Displaying
- Check that post is "Published"
- Check "Published At" date is in the past
- Clear browser cache

## 📚 Resources

- **Tiptap Docs**: https://tiptap.dev/docs
- **Filament Tiptap**: https://github.com/awcodes/filament-tiptap-editor
- **Tailwind Typography**: https://tailwindcss.com/docs/typography-plugin

## 🎉 Enjoy!

You now have a professional-grade content editor that rivals Medium, WordPress, and other major platforms. Create beautiful, rich content with ease!

---

**Questions?** Check the main README.md or DEPLOYMENT.md for more help.
