FROM debian:latest

RUN mkdir -p /usr/share/man/man1 && mkdir -p /usr/share/man/man7
ENV DEBIAN_FRONTEND noninteractive

# Install initial packages
RUN apt-get update \
    && apt-get install -y apt-utils \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install NPM (and node)
RUN apt-get update \
    && apt-get install -y \
    libjpeg62-turbo-dev \
    libpng-dev \
    npm \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \
    && npm install npm@latest -g

# Install any additional packages
RUN apt-get update \
    && apt-get install -y \
    openssh-client \
    procps \
    rsync \
    vim \
    screen \
    curl \
    && apt-get clean && apt-get autoremove && rm -rf /var/lib/apt/lists/*

# ARG app_user
ARG user
ENV user $user
RUN groupadd -g 1000 "$user" \
    && useradd -u 1000 -ms /bin/bash -g "${user}" "${user}"

# Change current user to www
USER ${user}

CMD ["bash"]