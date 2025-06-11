<select name="sort" onchange="this.form.submit()"
    class="mt-4 md:mt-0 md:ml-4 px-4 py-2 rounded bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
    <option value="">Sort By: Newest</option>
    <option value="title_asc" {{ request('sort')==='title_asc' ? 'selected' : '' }}>Title (A-Z)</option>
    <option value="title_desc" {{ request('sort')==='title_desc' ? 'selected' : '' }}>Title (Z-A)</option>
    <option value="rating" {{ request('sort')==='rating' ? 'selected' : '' }}>Highest Rating</option>
</select>