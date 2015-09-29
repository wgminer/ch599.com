#!flask/bin/python
from flask import Flask, jsonify, make_response

app = Flask(__name__)

@app.errorhandler(400)
def not_found(error):
    return make_response(jsonify( { 'error': 'Bad request' } ), 400)

@app.errorhandler(404)
def not_found(error):
    return make_response(jsonify( { 'error': 'Not found' } ), 404)

songs = [
    {
        'id': 1,
        'title': u'Buy groceries',
        'description': u'Milk, Cheese, Pizza, Fruit, Tylenol', 
        'done': False
    },
    {
        'id': 2,
        'title': u'Learn Python',
        'description': u'Need to find a good Python tutorial on the web', 
        'done': False
    }
]

users = [
    {
        'id': 1,
        'title': u'Buy groceries',
        'description': u'Milk, Cheese, Pizza, Fruit, Tylenol', 
        'done': False
    },
    {
        'id': 2,
        'title': u'Learn Python',
        'description': u'Need to find a good Python tutorial on the web', 
        'done': False
    }
]

genres = [
    {
        'id': 1,
        'title': u'Buy groceries',
        'description': u'Milk, Cheese, Pizza, Fruit, Tylenol', 
        'done': False
    },
    {
        'id': 2,
        'title': u'Learn Python',
        'description': u'Need to find a good Python tutorial on the web', 
        'done': False
    }
]

path = '/api'


# SONGS 
@app.route(path + '/songs', methods=['GET'])
def get_tasks():
    return jsonify({'songs': songs})

@app.route(path + '/songs/<int:song_id>', methods=['GET'])
def get_task(song_id):
    song = [song for song in songs if song['id'] == song_id]
    if len(song) == 0:
        abort(404)
    return jsonify({'song': song[0]})

@app.route('/todo/api/v1.0/tasks', methods = ['POST'])
@auth.login_required
def create_task():
    if not request.json or not 'title' in request.json:
        abort(400)
    task = {
        'id': tasks[-1]['id'] + 1,
        'title': request.json['title'],
        'description': request.json.get('description', ""),
        'done': False
    }
    tasks.append(task)
    return jsonify( { 'task': make_public_task(task) } ), 201


# USERS
@app.route(path + '/users', methods=['GET'])
def get_users():
    return jsonify({'users': users})

@app.route(path + '/users/<int:user_id>', methods=['GET'])
def get_user(user_id):
    user = [user for user in users if user['id'] == user_id]
    if len(user) == 0:
        abort(404)
    return jsonify({'user': user[0]})


# GENRES
@app.route(path + '/genres', methods=['GET'])
def get_genres():
    return jsonify({'genres': genres})

@app.route(path + '/genres/<int:genre_id>', methods=['GET'])
def get_genre(genre_id):
    genre = [genre for genre in genres if genre['id'] == genre_id]
    if len(genre) == 0:
        abort(404)
    return jsonify({'genre': genre[0]})


if __name__ == '__main__':
    app.run(debug=True)