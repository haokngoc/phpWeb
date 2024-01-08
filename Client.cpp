#include <iostream>
#include <fstream>
#include <cstring>
#include <sys/socket.h>
#include <netinet/in.h>
#include <unistd.h>
int main() {
    // Kết nối đến server
    int client_socket = socket(AF_INET, SOCK_STREAM, 0);
    if (client_socket == -1) {
        perror("Error creating socket");
        return 1;
    }

    sockaddr_in server_address;
    server_address.sin_family = AF_INET;
    server_address.sin_port = htons(12345);
    server_address.sin_addr.s_addr = htonl(INADDR_LOOPBACK);

    if (connect(client_socket, (struct sockaddr*)&server_address, sizeof(server_address)) == -1) {
        perror("Error connecting to server");
        close(client_socket);
        return 1;
    }

    // Đọc nội dung file JSON
    std::ifstream json_file("data.json", std::ios::binary);
    if (!json_file.is_open()) {
        std::cerr << "Error opening JSON file." << std::endl;
        close(client_socket);
        return 1;
    }

    // Gửi dữ liệu đến server
    char buffer[1024];
    while (!json_file.eof()) {
        json_file.read(buffer, sizeof(buffer));
        ssize_t sent_bytes = send(client_socket, buffer, json_file.gcount(), 0);
        if (sent_bytes == -1) {
            perror("Error sending data");
            close(client_socket);
            return 1;
        }
    }

    // Đóng kết nối
    close(client_socket);
    json_file.close();

    return 0;
}