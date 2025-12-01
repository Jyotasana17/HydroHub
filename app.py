from flask import Flask, request, jsonify
from flask_bcrypt import Bcrypt
from flask_cors import CORS
import mysql.connector

app = Flask(__name__)
bcrypt = Bcrypt(app)
CORS(app)

# MySQL Database Connection
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="mysql",
    database="hydrohub"
)
cursor = db.cursor(dictionary=True)


# ----------------------- REGISTER -----------------------
@app.route('/register', methods=['POST'])
def register():
    data = request.json

    email = data['email']
    username = data['username']
    password = data['password']

    hashed_pw = bcrypt.generate_password_hash(password).decode('utf-8')

    try:
        cursor.execute(
            "INSERT INTO users (email, username, password_hash) VALUES (%s, %s, %s)",
            (email, username, hashed_pw)
        )
        db.commit()
        return jsonify({"status": "success", "message": "User registered successfully"})
    except mysql.connector.Error as err:
        return jsonify({"status": "error", "message": str(err)})


# ----------------------- LOGIN -----------------------
@app.route('/login', methods=['POST'])
def login():
    data = request.json

    email = data['email']
    password = data['password']

    cursor.execute("SELECT * FROM users WHERE email=%s", (email,))
    user = cursor.fetchone()

    if not user:
        return jsonify({"status": "error", "message": "Invalid email or password"})

    if bcrypt.check_password_hash(user["password_hash"], password):
        return jsonify({
            "status": "success",
            "message": "Login successful",
            "user": {
                "id": user["id"],
                "email": user["email"],
                "username": user["username"]
            }
        })
    else:
        return jsonify({"status": "error", "message": "Invalid email or password"})


if __name__ == '__main__':
    app.run(debug=True)
