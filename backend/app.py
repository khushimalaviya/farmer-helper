import pandas as pd
import joblib
from flask import Flask, request, jsonify
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import OneHotEncoder
from sklearn.compose import ColumnTransformer
from sklearn.pipeline import Pipeline
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import classification_report

# Load and preprocess dataset
df = pd.read_csv("modified_dataset.csv")

# Fix spelling issue
df.rename(columns={"Temparature": "Temperature"}, inplace=True)

# Features and target
features = ["Soil Type", "Suitable Season", "Temperature", "Humidity"]
X = df[features]
y = df["Crop Type"]

# OneHotEncode Soil Type & Suitable Season
categorical_features = ["Soil Type", "Suitable Season"]
numeric_features = ["Temperature", "Humidity"]

# ColumnTransformer to handle encoding
preprocessor = ColumnTransformer(
    transformers=[
        ("cat", OneHotEncoder(handle_unknown="ignore"), categorical_features)
    ],
    remainder="passthrough"  # Keep numeric features
)

# Create pipeline with preprocessing + RandomForest
model_pipeline = Pipeline(steps=[
    ("preprocessor", preprocessor),
    ("classifier", RandomForestClassifier(
        n_estimators=300,
        max_depth=20,
        min_samples_split=4,
        class_weight="balanced",
        random_state=42
    ))
])

# Split data (stratified for balanced classes)
X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=0.2, stratify=y, random_state=42
)

# Train pipeline
model_pipeline.fit(X_train, y_train)

# Evaluate model
y_pred = model_pipeline.predict(X_test)
print("\nModel Evaluation Report:\n")
print(classification_report(y_test, y_pred))

# Save model pipeline
joblib.dump(model_pipeline, "final_crop_model.pkl")

# Create Flask app
app = Flask(__name__)

@app.route("/predict-crop", methods=["POST"])
def predict_crop():
    try:
        data = request.json

        # Load model pipeline
        model_pipeline = joblib.load("final_crop_model.pkl")

        # Extract inputs
        soil_type = data["soil_type"]
        season = data["season"]
        temp = float(data["temperature"])
        humidity = float(data["humidity"])

        # Prepare input as DataFrame
        input_df = pd.DataFrame([{
            "Soil Type": soil_type,
            "Suitable Season": season,
            "Temperature": temp,
            "Humidity": humidity
        }])

        # Predict probabilities
        proba = model_pipeline.predict_proba(input_df)[0]
        top_indices = proba.argsort()[-3:][::-1]
        top_classes = model_pipeline.named_steps['classifier'].classes_
        top_crops = [top_classes[i] for i in top_indices]
        top_probs = [round(proba[i] * 100, 2) for i in top_indices]

        # Build response
        result = [{"crop": crop, "confidence": f"{prob} %"} for crop, prob in zip(top_crops, top_probs)]
        return jsonify({"recommended_crops": result})

    except Exception as e:
        return jsonify({"error": str(e)}), 400

if __name__ == "__main__":
    app.run(port=5001)
