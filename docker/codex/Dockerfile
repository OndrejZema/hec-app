# Základní image s Node.js
FROM node:20-bookworm-slim

RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    curl \
    && update-ca-certificates \
    && rm -rf /var/lib/apt/lists/*

# Instalace OpenAI Codex CLI
RUN npm install -g @openai/codex

# Pracovní adresář
WORKDIR /workspace

# Default command
CMD ["codex"]
