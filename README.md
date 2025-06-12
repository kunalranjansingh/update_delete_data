# 📝 PHP CRUD App – Update, Delete & Display Single User Data

This PHP project allows you to **view**, **update**, and **delete** user records from a MySQL database. It also includes functionality to **display details of a single user** based on their ID.

## 🚀 Features

- 🔍 View all user data in a responsive HTML table
- ✏️ Update user information using a form
- ❌ Delete a user with a single click
- 👤 View details of an individual user (single record display)
- ✅ Clean UI with Bootstrap or custom CSS
- 🔐 Basic input validation

---

## 🛠️ Technologies Used

- PHP
- MySQL
- HTML/CSS
- Optional: Bootstrap for styling

---
<a href="r_form_edit.php?id=<?= urlencode($row['id']) ?>"><button>Edit</button></a>
<a href="r_form_delete.php?id=<?= urlencode($row['id']) ?>" onclick="return confirm('Are you sure?');"><button>Delete</button></a>
<a href="r_form_view.php?id=<?= urlencode($row['id']) ?>"><button>View</button></a>

