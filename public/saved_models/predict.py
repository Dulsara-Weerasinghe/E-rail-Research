import pickle

# Load the pickle file
model = pickle.load(open('public\saved_models\predict.py', 'rb'))

# Perform predictions
# ...

# Return the predictions (print them to be captured by PHP)
print(predictions)
